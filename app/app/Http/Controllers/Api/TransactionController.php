<?php

namespace App\Http\Controllers\Api;

use App\GeneralSettings;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function buyairtime(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'network' => 'required',
            'number' => 'required',
            'amount' => 'required|integer|min:100',
//
        ], [
            'password.required' => 'Please enter your transaction password',
            'number.required' => 'Please enter your mobile phone number',
            'network.required' => 'Please select a mobile network',
            'amount.required' => 'Please enter an amount to buy',
        ]);

        if ($request->amount > $user->balance) {
            return response()->json(['status' => 0, 'message' => 'Insufficient wallet balance. Please deposit more fund and try again']);
        }

        $trx = strtoupper(str_random(20));
        $basic = GeneralSettings::first();


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://openapi.rubiesbank.io/v1/ctairtimepurchase",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\n    \"reference\": \"$trx\",\n    \"amount\": \"$request->amount\",\n    \"mobilenumber\": \"$request->number\",\n    \"telco\": \"$request->network\"\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: ".$basic->rubies_secretkey
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $rep=json_decode($response, true);

        $product['user_id'] = Auth::id();
        $product['gateway'] = $request->network;
        $product['account_number'] = $request->number;
        $product['type'] = 1;
        $product['remark'] = $rep['responsemessage'];
        $product['trx'] = $trx;
        $product['status'] = 1;
        $product['amount'] = $request->amount;
        Transaction::create($product);

        $user = Auth::user();
        $user->balance = $user->balance - $request->amount;
        $user->save();

        return response()->json(['status' => 1, 'message' => 'Airtime sent successfully']);
    }

    public function buydata(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'plan' => 'required',
            'number' => 'required',
            'amount' => 'required',
            'network' => 'required',
        ], [
            'password.required' => 'Please enter your transaction password',
            'number.required' => 'Please enter your mobile phone number',
            'plan.required' => 'Please select an internet data plan',
        ]);

        $trx = strtoupper(str_random(20));
        $basic = GeneralSettings::first();

        if ($request->amount > $user->balance) {
            return response()->json(['status' => 0, 'message' => 'Insufficient wallet balance. Please deposit more fund and try again']);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://openapi.rubiesbank.io/v1/ctmobiledatapurchase",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\n    \"reference\": \"$trx\",\n    \"amount\": \"$request->amount\",\n    \"productcode\": \"$request->plan\",\n    \"mobilenumber\": \"$request->number\",\n    \"telco\": \"$request->network\"\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: ".$basic->rubies_secretkey

            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        $rep=json_decode($response, true);

        if($rep['responsecode'] == 00)
        {
            $product['user_id'] = Auth::id();
            $product['gateway'] = $request->network;
            $product['account_number'] = $request->number;
            $product['method'] = $request->name;
            $product['type'] = 2;
            $product['remark'] = $rep['responsemessage'];
            $product['trx'] = $trx;
            $product['status'] = 1;
            $product['amount'] = 100;
            Transaction::create($product);

            $user = Auth::user();
            $user->balance = $user->balance - $request->amount;
            $user->save();


            return response()->json(['status' => 1, 'message' => 'Internet data sent successfully']);
        }
        else{
            return response()->json(['status' => 0, 'message' => 'Server error, please try again later or contact admin if error persist']);
        }

    }

    public function buytv(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'decoder' => 'required',
            'amount' => 'required',
            'number' => 'required',
            'package' => 'required',
        ], [
            'password.required' => 'Please enter your transaction password',
            'package.required' => 'Please select a bouquet',
        ]);

        $basic = GeneralSettings::first();

        if ($request->amount + $basic->decoderfee > $user->balance) {
            return response()->json(['status' => 0, 'message' => 'Insufficient wallet balance. Please deposit more fund and try again']);
        }

        $basic = GeneralSettings::first();
        $baseUrl = "https://www.nellobytesystems.com";
        $endpoint = "/APICableTVV1.asp?UserID=".$basic->clubkonnect_id."&APIKey=".$basic->clubkonnect_key."&CableTV=".$request->decoder."&Package=".$request->package."&SmartCardNo=".$request->number."";

        $httpVerb = "GET";
        $contentType = "application/json"; //e.g charset=utf-8
        $headers = array (
            "Content-Type: $contentType",

        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $baseUrl.$endpoint);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = json_decode(curl_exec( $ch ),true);
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        curl_close($ch);
        $result = implode(', ', (array)$content);

        $statusResult=$content['status']; // Access Array data
        $total = $request->amount + $basic->decoderfee;

        if ($statusResult == "ORDER_RECEIVED" || $statusResult == "ORDER_COMPLETED") {
            $trx = strtoupper(str_random(20));

            $product['user_id'] = Auth::id();
            $product['gateway'] = $request->decoder;
            $product['method'] = $request->package;
            $product['account_number'] = $request->number;
            $product['type'] = 3; //check this if it is correct by you
            $product['remark'] = "TV Subscription was successful on ".$request->decoder." ".$request->package." bouquet";
            $product['trx'] = $trx;
            $product['status'] = 1;
            $product['amount'] = $request->amount;
            Transaction::create($product);


            $user = Auth::user();
            $total = $product['amount'] + $basic->decoderfee;
            $user->balance = $user->balance - $total;
            $user->save();

            return response()->json(['status' => 1, 'message' => $product['remark']]);
        }else {
            return response()->json(['status' => 1, 'message' => 'We cannot proces your selected subscription plan at the moment. Please Try Again']);
        }
    }

}
