<?php

namespace App\Http\Controllers\Api;

use App\GeneralSettings;
use App\Http\Controllers\Controller;
use App\Sms;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function buyairtime(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $rules = array(
            'network' => 'required',
            'number' => 'required|min:10',
            'amount' => 'required|integer|min:100',
        );

        $messages=[
            'password.required' => 'Please enter your transaction password',
            'number.required' => 'Please enter your mobile phone number',
            'network.required' => 'Please select a mobile network',
            'amount.required' => 'Please enter an amount to buy',
        ];

        $validator = Validator::make($input, $rules, $messages);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }


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

        if($rep['responsecode'] != 00)
        {
            return response()->json(['status' => 0, 'message' => 'Error while buying Airtime']);
        }

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
        $input = $request->all();
        $rules = array(
            'plan' => 'required',
            'number' => 'required',
            'amount' => 'required',
            'network' => 'required',
        );

        $messages=[
            'number.required' => 'Please enter your mobile phone number',
            'plan.required' => 'Please select an internet data plan',
        ];

        $validator = Validator::make($input, $rules, $messages);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

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
        $rep=json_decode($response, true);

        if($rep['responsecode'] != 00)
        {
            return response()->json(['status' => 0, 'message' => 'Server error, please try again later or contact admin if error persist']);
        }
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

    public function buytv(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $rules = array(
            'decoder' => 'required',
            'amount' => 'required',
            'number' => 'required',
            'package' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

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
            return response()->json(['status' => 0, 'message' => 'We cannot process your selected subscription plan at the moment. Please Try Again']);
        }
    }

    public function sendsms(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'message' => 'required|string|max:160',
            'phone' => 'required|string|max:11',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $user = Auth::user();

        $basic = GeneralSettings::first();
        if ($user->balance < $basic->smscharge) {
            return response()->json(['status' => 2, 'message' => 'Insufficient wallet balance. Please deposit more fund and try again']);
        }

       send_sms($request->phone, $request->message);

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
        $input = $request->all();
        $rules = array(
            'amount' => 'required|integer|min:100',
            'meternumber' => 'required',
            'code' => 'required',
            'type' => 'required',
            'name' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

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
            return response()->json(['status' => 0, 'message' => $result['message']]);
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

            return response()->json(['status' => 1, 'message' => $product['remark']]);

        } else {
            return response()->json(['status' => 0, 'message' => 'We cannot process your request at the moment, please try again later']);
        }

    }

    public function banktransfer(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $rules = array(
            'amount' => 'required',
            'narration' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }


        $basic = GeneralSettings::first();
        $total = $basic->transcharge + $request->amount;
        if ($total > $user->balance) {
            return response()->json(['status' => 2, 'message' => 'Insufficient wallet balance. Please deposit more fund and try again']);
        }

        $trx = strtoupper(str_random(20));

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://openapi.rubiesbank.io/v1/fundtransfer",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\n    \"reference\": \"$trx\",\n    \"amount\": \"$request->amount\",\n    \"narration\": \"$request->naration\",\n    \"craccountname\": \"$user->fname $user->lname\",\n    \"bankname\": \"$user->bank\",\n    \"draccountname\": \"$user->fname $user->lname\",\n    \"craccount\": \"$request->accountno\",\n    \"bankcode\": \"$request->bankcode\"\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: ".$basic->rubies_secretkey,
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $rep=json_decode($response, true);

        if($rep['responsecode'] == 00)
        {
            $product['user_id'] = Auth::id();
            $product['gateway'] = $request->bank;
            $product['method'] = $request->name;
            $product['account_number'] = $request->number;
            $product['type'] = 5;
            $product['remark'] = $rep['nibssresponsemessage'];
            $product['trx'] = $trx;
            $product['status'] = 1;
            $product['amount'] = $request->amount;
            Transaction::create($product);


            $user = Auth::user();
            $user->balance = $user->balance - $total;
            $user->save();


            return response()->json(['status' => 1, 'message' => 'Fund transfer was successful']);
        }
        else{
            return response()->json(['status' => 0, 'message' => 'Sorry, you cant make transfer at the moment, please try again later.']);
        }

    }

    public function otherbanktransfer(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $rules = array(
            'bank' => 'required',
            'accountnumber' => 'required',
            'accountname' => 'required',
            'naration' => 'required',
            'amount' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $basic = GeneralSettings::first();
        $total = $basic->transcharge + $request->amount;

        if ($total > $user->balance) {
            return response()->json(['status' => 2, 'message' => 'Insufficient wallet balance. Please deposit more fund and try again']);
        }

        $bank = $request->bank;
        $name = $request->accountname;
        $amount = $request->amount;
        $number = $request->accountnumber;
        $trx = strtoupper(str_random(20));



        if ($user->balance >= $total )
        {
            $product['user_id'] = Auth::id();
            $product['gateway'] = $bank;
            $product['method'] = $name;
            $product['account_number'] = $number;
            $product['type'] = 5;
            $product['remark'] = $request->naration;
            $product['trx'] = $trx;
            $product['status'] = 0;
            $product['amount'] = $amount;
            Transaction::create($product);

            $user = Auth::user();
            $user->balance = $user->balance - $total;
            $user->save();

            return response()->json(['status' => 1, 'message' => 'Fund transfer was successful. Please wait while we process your transfer']);
        }
        else{
            return response()->json(['status' => 0, 'message' => 'Sorry, you cant make transfer at the moment, please try again later.']);
        }
    }

    public function walletransfer(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $rules = array(
            'number' => 'required',
            'naration' => 'required',
            'amount' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $basic = GeneralSettings::first();
        $total = $request->amount;

        if ($total > $user->balance) {
            return response()->json(['status' => 2, 'message' => 'Insufficient wallet balance. Please deposit more fund and try again']);
        }

        $amount = $request->amount;
        $number = $request->number;
        $trx = strtoupper(str_random(20));

        $r=User::where('account_number', '=',$number)->first();

        if(!$r){
            return response()->json(['status' => 0, 'message' => 'Recipient did not exist']);
        }

        if ($user->balance >= $total )
        {
            $product['user_id'] = Auth::id();
            $product['gateway'] = "Wallet Transfer";
            $product['method'] = $r->fname . " ". $r->lname;
            $product['account_number'] = $number;
            $product['type'] = 5;
            $product['remark'] = $request->naration;
            $product['trx'] = $trx;
            $product['status'] = 1;
            $product['amount'] = $amount;
            Transaction::create($product);

            $product['user_id'] = $r->id;
            $product['method'] = $user->fname . " ". $user->lname;
            $product['account_number'] = $user->account_number;
            Transaction::create($product);

            $user->balance = $user->balance - $total;
            $user->save();

            $r->balance = $r->balance + $total;
            $r->save();

            return response()->json(['status' => 1, 'message' => 'Fund transfer was successful. Please wait while we process your transfer']);
        }
        else{
            return response()->json(['status' => 0, 'message' => 'Sorry, you cant make transfer at the moment, please try again later.']);
        }
    }

}
