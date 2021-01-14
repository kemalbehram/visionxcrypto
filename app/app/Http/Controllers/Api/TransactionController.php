<?php

namespace App\Http\Controllers\Api;

use App\Currency;
use App\Gateway;
use App\GeneralSettings;
use App\Http\Controllers\Controller;
use App\Invest;
use App\Message;
use App\Plan;
use App\Sms;
use App\TimeSetting;
use App\Transaction;
use App\Trx;
use App\User;
use App\VirtualCard;
use Carbon\Carbon;
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
        $product['gateway'] = $request->network . " airtime";
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
            $product['gateway'] = $request->network . " data";
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
            $product['details'] = $request->name . " (Meter Number: " . $request->meternumber . ")";
            $product['account_number'] = $request->meternumber;
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

            return response()->json(['status' => 1, 'message' => $product['remark'], 'pin'=>$product['pin']]);

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
            $product['gateway'] = "Bank Transfer";
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
        $user = User::find(Auth::id());
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

            Message::create([
                'user_id' => $user->id,
                'title' => "Payment Sent",
                'details' =>"Your payment has been sent successfully to " . $product['method'],
                'admin' => 1,
                'status' =>  0
            ]);

            return response()->json(['status' => 1, 'message' => 'Fund transfer was successful. Please wait while we process your transfer']);
        }
        else{
            return response()->json(['status' => 0, 'message' => 'Sorry, you cant make transfer at the moment, please try again later.']);
        }
    }

    public function createVXC(Request $request){
        $user = Auth::user();
        $input = $request->all();
        $rules = array(
            'name' => 'required',
            'amount' => 'required|integer|min:1',
            'country' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }


        $basic = GeneralSettings::first();

        if($input['country']=="NG"){
            $input['currency']="NGN";
            $da=$input['amount'];
        }else{
            $input['currency']="USD";
            $da=$input['amount'] * $basic->dollar_rate;
        }

        $input['address']="333 fremont road";
        $input['city']="San Francisco";
        $input['state']="CA";
        $input['postal_code']="98410";

        $ab=$da+ $basic->card_create_charges;

        if ($ab > $user->balance) {
            return response()->json(['status' => 2, 'message' => 'Insufficient wallet balance. Please deposit more fund and try again']);
        }


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $basic->	flutterwave_url."/virtual-cards",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n    \"currency\": \"".$input['currency']."\",\n    \"amount\": ".$input['amount'].",\n    \"billing_name\": \"".$input['name']."\",\n    \"billing_address\": \"".$input['address']."\",\n    \"billing_city\": \"".$input['city']."\",\n    \"billing_state\": \"".$input['state']."\",\n    \"billing_postal_code\": \"".$input['postal_code']."\",\n    \"billing_country\": \"".$input['country']."\",\n    \"callback_url\": \"https://your-callback-url.com/\"\n}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ". $basic->flutterwave_seckey
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);


//        $response = '{ "status": "success", "message": "Card created successfully", "data": { "id": "43ec6e92-9eb7-48ad-91c8-7bee425a33cf", "account_id": 65637, "amount": "20,000.00", "currency": "NGN", "card_hash": "43ec6e92-9eb7-48ad-91c8-7bee425a33cf", "card_pan": "5366130699778900", "masked_pan": "536613*******8900", "city": "Lekki", "state": "Lagos", "address_1": "19, Olubunmi Rotimi", "address_2": null, "zip_code": "23401", "cvv": "134", "expiration": "2023-01", "send_to": null, "bin_check_name": null, "card_type": "mastercard", "name_on_card": "Jermaine Graham", "created_at": "2020-01-17T18:33:29.0130255+00:00", "is_active": true, "callback_url": null } }';

        $res=json_decode($response, true);

        if($res['status']=="success") {
            $trx = strtoupper(str_random(20));

            $product['user_id'] = Auth::id();
            $product['gateway'] = "Virtual card";
            $product['account_number'] = $res['data']['masked_pan'];
            $product['type'] = 1;
            $product['remark'] = "Virtual card created successfully";
            $product['trx'] = $trx;
            $product['status'] = 1;
            $product['amount'] = $request->amount;

            Transaction::create($product);

            $user->balance = $user->balance - $da - $basic->card_create_charges;
            $user->save();

            $input['user_id'] = Auth::id();
            $input['pan'] = $res['data']['card_pan'];
            $input['masked_pan'] = $res['data']['masked_pan'];
            $input['cvv'] = $res['data']['cvv'];
            $input['card_id'] = $res['data']['id'];
            $input['expiration'] = $res['data']['expiration'];
            $input['type'] = $res['data']['card_type'];

            VirtualCard::create($input);

            return response()->json(['status' => 1, 'message' => 'Virtual card created successfully.']);

        }else{
            return response()->json(['status' => 0, 'message' => 'Sorry, you cant make transaction at the moment, please try again later.']);
        }

    }

    public function deleteVXC(Request $request){
        $input = $request->all();
        $rules = array(
            'id' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $card=VirtualCard::find($request->id);

        if(!$card){
            return response()->json(['status' => 0, 'message' => 'Card does not exist']);
        }

        if($card->user_id != Auth::id()){
            return response()->json(['status' => 0, 'message' => 'Card does not exist']);
        }

        if($card->status == "terminated"){
            return response()->json(['status' => 0, 'message' => 'Card already terminated']);
        }

        $basic = GeneralSettings::first();
        $user = Auth::user();

        if ($basic->card_terminate_charges > $user->balance) {
            return response()->json(['status' => 2, 'message' => 'Insufficient wallet balance. Please deposit more fund and try again']);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $basic->	flutterwave_url."/virtual-cards/".$card->card_id."/terminate",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$basic->flutterwave_seckey
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);


//        $response='{ "status": "success", "message": "Card funded successfully", "data": null }';

        $res=json_decode($response, true);

        if($res['status']=="success") {
            $card->status="terminated";
            $card->save();

            $user->balance = $user->balance - $basic->card_terminate_charges;
            $user->save();

            return response()->json(['status' => 1, 'message' => 'Virtual card terminated successfully.']);

        }else{
            return response()->json(['status' => 0, 'message' => 'Sorry, you cant make transaction at the moment, please try again later.']);
        }
    }


    public function fundVXC(Request $request){
        $input = $request->all();
        $rules = array(
            'id' => 'required',
            'amount' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $card=VirtualCard::find($request->id);
        $user=Auth::user();
        $basic = GeneralSettings::first();

        if(!$card){
            return response()->json(['status' => 0, 'message' => 'Card does not exist']);
        }

        if($card->user_id != Auth::id()){
            return response()->json(['status' => 0, 'message' => 'Card does not exist']);
        }

        if($card->status == "terminated"){
            return response()->json(['status' => 0, 'message' => 'Card already terminated']);
        }

        if($card->currency=="NGN"){
            $da=$input['amount'];
        }else{
            $da=$input['amount'] * $basic->dollar_rate;
        }

        if ($da > $user->balance ) {
            return response()->json(['status' => 2, 'message' => 'Insufficient wallet balance. Please deposit more fund and try again']);
        }


//
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $basic->	flutterwave_url."/virtual-cards/".$card->card_id."/fund",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\n    \"debit_currency\": \"".$card->currency."\",\n    \"amount\": ".$input['amount']."\n}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $basic->flutterwave_seckey"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);


//        $response='{ "status": "success", "message": "Card funded successfully", "data": null }';

        $res=json_decode($response, true);

        if($res['status']=="success") {
            $trx = strtoupper(str_random(20));

            $product['user_id'] = Auth::id();
            $product['gateway'] = "Fund Virtual card";
            $product['account_number'] = $card->masked_pan;
            $product['type'] = 1;
            $product['remark'] = "Virtual card credited successfully with " .$card->currency. $input['amount'];
            $product['trx'] = $trx;
            $product['status'] = 1;
            $product['amount'] = $input['amount'];

            Transaction::create($product);

            $user->balance = $user->balance - $da;
            $user->save();

            $card->amount=$card->amount+$input['amount'];
            $card->save();
            return response()->json(['status' => 1, 'message' => 'Fund of '.$input['amount'].' has been added successfully.']);
        }else{
            return response()->json(['status' => 0, 'message' => 'Sorry, you cant make transaction at the moment, please try again later.']);
        }

    }

    public function withdrawVXC(Request $request){
        $input = $request->all();
        $rules = array(
            'id' => 'required',
            'amount' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $card=VirtualCard::find($request->id);
        $user=Auth::user();
        $basic = GeneralSettings::first();

        if(!$card){
            return response()->json(['status' => 0, 'message' => 'Card does not exist']);
        }

        if($card->user_id != Auth::id()){
            return response()->json(['status' => 0, 'message' => 'Card does not exist']);
        }

        if($card->status == "terminated"){
            return response()->json(['status' => 0, 'message' => 'Card already terminated']);
        }


//
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $basic->	flutterwave_url."/virtual-cards/".$card->card_id."/withdraw",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\n    \"amount\": ".$input['amount']."\n}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $basic->flutterwave_seckey"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);


//        $response='{ "status": "success", "message": "Card funded successfully", "data": null }';

        $res=json_decode($response, true);

        if($res['status']=="success") {

            $trx = strtoupper(str_random(20));

            $product['user_id'] = Auth::id();
            $product['gateway'] = "Virtual card withdrawal";
            $product['account_number'] = $card->masked_pan;
            $product['type'] = 1;
            $product['remark'] = "Virtual card fund withdrawal successfully";
            $product['trx'] = $trx;
            $product['status'] = 1;
            $product['amount'] = $request->amount;

            Transaction::create($product);

            if($card->currency=="NGN"){
                $da=$input['amount'];
            }else{
                $da=$input['amount'] * $basic->dollar_rate;
            }

            $user->balance = $user->balance + $da;
            $user->save();

            return response()->json(['status' => 1, 'message' => 'Withdrawal of '.$input['amount'].' was successfully.']);
        }else{
            return response()->json(['status' => 0, 'message' => 'Sorry, you cant make transaction at the moment, please try again later.']);
        }

    }

    public function createInvestment(Request $request){
        $input = $request->all();
        $rules = array(
            'id' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }


        $baseUrl = "https://blockchain.info/";
        $endpoint = "tobtc?currency=USD&value=1";
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

        $btcrate = json_decode(curl_exec( $ch ),true);
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        curl_close($ch);

        $btc = $request->amount * $btcrate;
        $user = User::find(Auth::id());
        $gnl = GeneralSettings::first();

        $plan = Plan::where('id', $request->id)->where('status', 1)->first();
        if (!$plan) {
            return response()->json(['status' => 0, 'message' => 'Invalid Plan Selected!']);
        }

        if ($plan->fixed_amount > $user->balance ) {
            return response()->json(['status' => 2, 'message' => 'Insufficient wallet balance. Please deposit more fund and try again']);
        }

        $userWallet = User::find(Auth::id());

        $user = User::find(Auth::id());
        $gnl = GeneralSettings::first();

        $time_name = TimeSetting::where('time', $plan->times)->first();
        $now = Carbon::now();

        //start
        if ($plan->interest_status == 1) {
            $interest_amount = ($request->amount * $plan->interest) / 100;
        } else {
            $interest_amount = $plan->interest;
        }
        $period = ($plan->lifetime_status == 1) ? '-1' : $plan->repeat_time;
        //end


        $trxx = rand(000000, 999999) . rand(000000, 999999);

        $data['user_id'] = $user->id;
        $data['plan_id'] = $plan->id;
        $data['amount'] = $plan->fixed_amount;
        $data['interest'] = $interest_amount;
        $data['period'] = $period;
        $data['time_name'] = $time_name->name;
        $data['hours'] = $plan->times;
        $invest['btcvalue'] = $plan->fixed_amount * $btcrate;
        $data['next_time'] = Carbon::parse($now)->addHours($plan->times);
        $data['status'] = 1;
        $data['capital_status'] = $plan->capital_back_status;
        $data['trx'] = rand(000000, 999999) . rand(000000, 999999);
        $a = Invest::create($data);

        $user->balance-=$plan->fixed_amount;
        $user->save();

        return response()->json(['status' => 1, 'message' => 'Your investment is successful']);

    }

    public function buycrypto(Request $request)
    {
        $user = Auth::user();

        $input = $request->all();
        $rules = array(
            'currency' => 'required',
            'usd' => 'required',
            'wallet' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }



        $auth = Auth::user();
        $basic = GeneralSettings::first();
        $currency = Currency::where('name',$input['currency'])->first();
        $trx = rand(000000, 999999) . rand(000000, 999999);

        $charge = $basic->transcharge;
        $usd = $request->usd * $currency->sell;
        $topay = $usd + $charge;
        $get = $request->usd/$currency->price;

        if ($topay > $user->balance ) {
            return response()->json(['status' => 2, 'message' => 'Insufficient wallet balance. Please deposit more fund and try again']);
        }

        $buy['currency_id'] = $currency->id;
        $buy['amount'] =  $request->usd;
        $buy['main_amo'] = $topay;
        $buy['charge'] = $charge;
        $buy['price'] = $currency->price;
        $buy['getamo'] = $get;
        $buy['user_id'] = Auth::id();
        $buy['type'] = 1;
        $buy['wallet'] = $request->wallet;
        $buy['rate'] = $currency->sell;
        $buy['bank'] = $request->bank;
        $buy['remark'] = $request->comment;
        $buy['status'] = 0;
        $buy['trx'] = $trx;
        Trx::create($buy)->trx;

        return response()->json(['status' => 1, 'message' => 'Transaction is successful']);

    }

    public function sellcrypto(Request $request)
    {

        $user = Auth::user();

        $input = $request->all();
        $rules = array(
            'currency' => 'required',
            'usd' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $auth = Auth::user();
        $basic = GeneralSettings::first();
        $currency = Currency::whereId($request->coin)->first();
        $trx = rand(000000, 999999) . rand(000000, 999999);


        $charge = $basic->transcharge;
        $usd = $request->usd * $currency->buy;
        $topay = $usd + $charge;


        $buy['currency_id'] = $currency->id;
        $buy['amount'] =  $request->usd;
        $buy['main_amo'] = $topay;
        $buy['charge'] = $charge;
        $buy['price'] = $currency->price;
        $buy['user_id'] = Auth::id();
        $buy['type'] = 2;
        $buy['bank'] = 0;
        $buy['bankname'] = "VisionX";
        $buy['accountname'] = $auth->username;
        $buy['accountnumber'] = $auth->account_number;
        $buy['rate'] = $currency->buy;
        $buy['status'] = 0;
        $buy['trx'] = $trx;

        Trx::create($buy)->trx;


//		$baseurl = "https://coinremitter.com/api/v3/".$currency->symbol."/create-invoice";
        $baseurl = "https://coinremitter.com/api/v3/TCN/create-invoice";
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
            CURLOPT_POSTFIELDS => array('api_key' => '$2y$10$5s1pl64ibsMQ1waqpBTrM.vsIWoZSio.6S/hWaTzDnMOeFsOZ8Gau','password' => 'visionxcrypto','amount' => $data->amount,'name' => $data->trx,'currency' => 'USD','expire_time' => '15', 'suceess_url' => url("/api/sellcallback")),
        ));

        $response = curl_exec($curl);
        $reply = json_decode($response,true);

        $address = $reply['data']['address'];
        $btcvalue = $reply['data']['total_amount']['TCN'];
//		$btcvalue = $reply['data']['total_amount']['BTC'];

        return response()->json(['status' => 1, 'message' => 'Transaction logged successfully', 'address'=>$address, 'btcvalue'=>$btcvalue]);

    }


}
