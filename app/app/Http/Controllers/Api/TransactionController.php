<?php

namespace App\Http\Controllers\Api;

use App\GeneralSettings;
use App\Http\Controllers\Controller;
use App\Sms;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function buyairtime(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'network' => 'required',
            'number' => 'required|integer|min:11|max:11',
            'amount' => 'required|integer|min:100',
//
        ], [
            'password.required' => 'Please enter your transaction password',
            'number.required' => 'Please enter your mobile phone number',
            'network.required' => 'Please select a mobile network',
            'amount.required' => 'Please enter an amount to buy',
        ]);

        if ($request->amount > $user->balance) {
            return response()->json(['status' => 2, 'message' => 'Insufficient wallet balance. Please deposit more fund and try again']);
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
            return response()->json(['status' => 2, 'message' => 'Insufficient wallet balance. Please deposit more fund and try again']);
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
            return response()->json(['status' => 2, 'message' => 'Insufficient wallet balance. Please deposit more fund and try again']);
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
        } else {
            return response()->json(['status' => 1, 'message' => 'We cannot process your selected subscription plan at the moment. Please Try Again']);
        }
    }

    public function sendsms(Request $request)
    {

        $request->validate([
            'message' => 'required|string|max:160',
            'phone' => 'required|string|max:11',
        ]);

        $user = Auth::user();

        $basic = GeneralSettings::first();
        if ($user->balance < $basic->smscharge) {
            return response()->json(['status' => 2, 'message' => 'Insufficient wallet balance. Please deposit more fund and try again']);
        }

        $message = utf8_encode(urlencode($request->message));
        $baseUrl = "https://www.bulksmsnigeria.com/";
        $endpoint = "api/v1/sms/create?api_token=" . $basic->sms_token . "&from=SMS&to=" . $request->phone . "&body=" . $message . "";
        $httpVerb = "GET";
        $contentType = "application/json"; //e.g charset=utf-8
        $headers = array(
            "Content-Type: $contentType",

        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = json_decode(curl_exec($ch), true);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        curl_close($ch);


        $tr = strtoupper(str_random(20));
        $w['transaction_id'] = $tr;
        $w['user_id'] = Auth::user()->id;
        $w['message'] = $request->message;
        $w['amount'] = $basic->smscharge;
        $w['phone'] = $request->phone;
        $trr = Sms::create($w);

        $user->balance = $user->balance - $basic->smscharge;
        $user->save();

        return response()->json(['status' => 1, 'message' => 'Message Sent To Number']);

    }

    public function paypower(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'amount' => 'required|integer|min:100',
            'meternumber' => 'required',
            'code' => 'required',
            'type' => 'required',
            'name' => 'required',
        ], [
            'password.required' => 'Please enter your transaction password',
            'amount.required' => 'Please enter an amount',
        ]);


        $basic = GeneralSettings::first();
        $total = $basic->electricityfee + $request->amount;

        if ($total > $user->balance) {
            return response()->json(['status' => 2, 'message' => 'Insufficient wallet balance. Please deposit more fund and try again']);
        }

        $basic = GeneralSettings::first();
        $trx = strtoupper(str_random(6));
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://openapi.rubiesbank.io/v1/billerpurchase",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            //CURLOPT_POSTFIELDS =>"{\n    \"reference\": \"$trx\",\n    \"billercustomerid\": \"$request->number\",\n    \"productcode\": \"$request->type\",\n    \"amount\": \"$request->amount\n    \"mobilenumber\": \"$user->phone\",\n    \"name\": \"$request->name\",\n    \"billercode\": \"$request->meter\"\n}",
            //CURLOPT_HTTPHEADER => array(
            CURLOPT_POSTFIELDS => "{\n    \"reference\": \"$trx\",\n    \"billercustomerid\": \"$request->meternumber\",\n    \"productcode\": \"$request->type\",\n    \"amount\": \"$request->amount\",\n    \"mobilenumber\": \"08031975397\",\n    \"name\": \"$request->name\",\n    \"billercode\": \"$request->code\"\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: " . $basic->rubies_secretkey
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response, true);

        if (isset($result['message'])) {
            return back()->with('danger', $result['message']);
        }


        if ($result['responsecode'] == 00) {
            $product['user_id'] = Auth::id();
            $product['gateway'] = $request->meter;
            $product['method'] = $request->type;
            $product['details'] = $request->name . " (Meter Number: " . $request->number . ")";
            $product['account_number'] = $request->number;
            $product['ref'] = $result['cbareference'];
            $product['pin'] = $result['pin']['pinCode'];
            $product['serial'] = $result['pin']['serialNumber'];
            $product['unit'] = $result['pin']['units'];
            $product['type'] = 4; //check this if it is correct by you
            $product['remark'] = "Meter payment was successful on ";
            $product['trx'] = $trx;
            $product['status'] = 1;
            $product['amount'] = $request->amount;
            Transaction::create($product);


            $user = Auth::user();
            $user->balance = $user->balance - $total;
            $user->save();


            session()->forget('meter');
            session()->forget('number');
            session()->forget('name');

            return redirect()->route('utilitybill')->with(['modal' => 'power', "success" => $product['remark']]);
        } else {
            return back()->with('danger', 'We cannot process your request at the moment, please try again later');
        }

    }

}
