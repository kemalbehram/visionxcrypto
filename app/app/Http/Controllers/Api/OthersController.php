<?php

namespace App\Http\Controllers\Api;

use App\Deposit;
use App\GeneralSettings;
use App\Message;
use App\Password;
use App\Transaction;
use App\User;
use App\Verification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OthersController extends Controller
{
    public function readNotifications(){
        $user=User::find(Auth::id());

        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        return response()->json(['status' => 1, 'message' => 'Notifications read successfully']);
    }

    public function password(Request $request){
        $input=$request->all();
        $rules = array(
            'reason' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $input['user_id']=Auth::id();

        Password::create($input);


        return response()->json(['status' => 1, 'message' => 'Reason logged successfully']);
    }

    public function uploadprofile(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'image' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $user = User::findOrFail(Auth::user()->id);

        if($input['image']) {
            $filename = time() . '_' . Auth::user()->username . '.jpg';
            $location = 'assets/images/user/' . $filename;
            $in['image'] = $location;

            $file_data = $input['image'];
            //generating unique file name;
            @list($type, $file_data) = explode(';', $file_data);
            @list(, $file_data) = explode(',', $file_data);
            if ($file_data != "") {
                // storing image in storage/app/public Folder
//                \Storage::disk('public')->put($file_name, base64_decode($file_data));
                \File::put(storage_path('../../') . $location, base64_decode($file_data));

                //Storage::put('/' . $file_name, $file_data, 'public');
            }
        }


        $user->fill($in)->save();

        return response()->json(['status' => 1, 'message' => 'Profile Picture submitted successfully', 'image' => $user->image]);
    }

    public function lockaccount(){
        $user = Auth::user();
        $user->withdrawpass_used = 3;
        $user->locked = 1;
        $user->save();
        return response()->json(['status' => 1, 'message' => 'Account locked successfully']);
    }

    public function topup(Request $request)
    {
        $user = Auth::user();

        $input = $request->all();
        $rules = array(
            'amount' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $trx ="topup". rand(000000, 999999);

        Deposit::create([
           'user_id'=>Auth::id(),
           'usd'=>$request->amount,
           'trx'=>$trx,
        ]);

        $basic = GeneralSettings::first();
        $akey=$basic->bitcoin_address;
        $baseurl = "https://coinremitter.com/api/v3/BTC/create-invoice";

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseurl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('api_key' => $akey, 'password' => 'visionxcrypto', 'amount' => round($request->amount/$basic->rate,4), 'name' => $trx, 'currency' => 'USD', 'expire_time' => '15', 'suceess_url' => url("/api/sellcallback")),
        ));

        $response = curl_exec($curl);
        $reply = json_decode($response, true);
        curl_close($curl);
        //return $response;

        if(!isset($reply['data']['address'])){
            return response()->json(['status' => 2, 'message' => 'Amount too low']);
        }
        $now = Carbon::now();
        $expire = Carbon::parse($now)->addMonth($request->duration);

        $address = $reply['data']['address'];
        $invoiceid = $reply['data']['invoice_id'];
        $btcvalue = $reply['data']['total_amount']['BTC'];

        $lock['user_id'] = Auth::id();
        $lock['invoiceid'] = $invoiceid;
        $lock['amount'] = $request->amount*$basic->rate;
        $lock['status'] = 0;
        $lock['code'] = $trx;
        $lock['expire'] = $expire;
        $lock['usd'] = $request->amount;
        $lock['btc'] = $btcvalue;
        $lock['address'] = $address;


        return response()->json(['status' => 1, 'message' => 'Transaction logged successfully', 'address'=>$address, 'btcvalue'=>$btcvalue, 'trx'=> $trx]);
    }

    public function payreferral($user, $amnt, $trx){
        if($user->refer!=0){
            $ruser=User::find($user->refer);
            $amont=($amnt/10);
            $amount=$amont*2;

            $product['user_id'] = $ruser->user_id;
            $product['gateway'] = "Referal Bonus";
            $product['account_number'] = $trx;
            $product['type'] = 1;
            $product['remark'] = "C";
            $product['trx'] = "refb_".$trx;
            $product['status'] = 1;
            $product['amount'] = $amount;
            Transaction::create($product);

            $ruser->balance += $amount;
            $ruser->save();
        }
    }
}
