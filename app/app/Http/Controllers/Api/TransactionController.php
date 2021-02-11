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
use App\Vxvault;
use App\Vxvaultwithdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

        if(strtolower($request->network)=="mtn"){
            $net=01;
        }elseif(strtolower($request->network)=="glo"){
            $net=02;
        }elseif(strtolower($request->network)=="9mobile"){
            $net=03;
        }elseif(strtolower($request->network)=="airtel"){
            $net=04;
        }else{
            $net=0;
        }

        $baseUrl = "https://www.nellobytesystems.com";
        $endpoint = "/APIAirtimeV1.asp?UserID=".$basic->clubkonnect_id."&APIKey=".$basic->clubkonnect_key."&MobileNetwork=".$net."&MobileNumber=".$request->number."&Amount=".$request->amount."&RequestID=".$trx."&CallBackURL=http://www.your-website.com";

        $url=$baseUrl.$endpoint;
        // Perform initialize to validate name on server
        $result = file_get_contents($url);
        $rep=json_decode($result, true);

        if($rep['status'] != "ORDER_RECEIVED")
        {
            return response()->json(['status' => 0, 'message' => 'Error while buying Airtime']);
        }

        $product['user_id'] = Auth::id();
        $product['gateway'] = $request->network . " airtime";
        $product['account_number'] = $request->number;
        $product['type'] = 1;
        $product['remark'] = $rep['status'];
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

        if(strtolower($request->network)=="mtn"){
            $net=01;
        }elseif(strtolower($request->network)=="glo"){
            $net=02;
        }elseif(strtolower($request->network)=="9mobile"){
            $net=03;
        }elseif(strtolower($request->network)=="airtel"){
            $net=04;
        }else{
            $net=0;
        }

        $baseUrl = "https://www.nellobytesystems.com";
        $endpoint = "/APIDatabundleV1.asp?UserID=".$basic->clubkonnect_id."&APIKey=".$basic->clubkonnect_key."&MobileNetwork=".$net."&MobileNumber=".$request->number."&DataPlan=".$request->plan."&RequestID=".$trx."&CallBackURL=http://www.your-website.com";

        $url=$baseUrl.$endpoint;
        // Perform initialize to validate name on server
        $result = file_get_contents($url);
        $rep=json_decode($result, true);

        if($rep['status'] != "ORDER_RECEIVED")
        {
            return response()->json(['status' => 0, 'message' => 'Server error, please try again later or contact admin if error persist']);
        }
            $product['user_id'] = Auth::id();
            $product['gateway'] = $request->network . " data";
            $product['account_number'] = $request->number;
            $product['method'] = $request->name;
            $product['type'] = 2;
            $product['remark'] = $rep['status'];
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

            $baseUrl = "https://www.bulksmsnigeria.com/";
            $endpoint = "api/v1/sms/create?api_token=".$basic->sms_token."&from=VISIONX&to=".$request->phone."&body=". $request->message."";
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


        $tr = strtoupper(str_random(20));
        $w['transaction_id'] = $tr;
        $w['user_id'] = Auth::user()->id;
        $w['message'] = $request->message;
        $w['amount'] = $basic->smscharge;
        $w['phone'] = $request->phone;
        $trr = Sms::create($w);

        $trx = strtoupper(str_random(20));
        $product['user_id'] = Auth::id();
        $product['gateway'] ="SMS";
        $product['method'] = $request->package;
        $product['account_number'] = $request->phone;
        $product['type'] = 3; //check this if it is correct by you
        $product['remark'] = "SMS sent successfully to ".$request->phone;
        $product['trx'] = $trx;
        $product['status'] = 1;
        $product['amount'] = $basic->smscharge;
        Transaction::create($product);

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

        if(strtolower($request->type)=="prepaid"){
            $type=01;
        }else{
            $type=02;
        }


        https://www.nellobytesystems.com/APIElectricityV1.asp?UserID=your_userid&APIKey=your_apikey&ElectricCompany=electric_company_code&MeterType=meter_type&MeterNo=meter_no&Amount=_amount&RequestID=request_id&CallBackURL=callback_url

        $baseUrl = "https://www.nellobytesystems.com";
        $endpoint = "/APIElectricityV1.asp?UserID=".$basic->clubkonnect_id."&APIKey=".$basic->clubkonnect_key."&ElectricCompany=".$request->code."&MeterNo=".$request->meternumber."&MeterType=".$type."&Amount=".$request->amount."&RequestID=".$trx."&CallBackURL=http://www.your-website.com";

        $url=$baseUrl.$endpoint;
        // Perform initialize to validate name on server
        $result = file_get_contents($url);
        $rep=json_decode($result, true);


        if($rep['status'] == "ORDER_RECEIVED"){
            $product['user_id'] = Auth::id();
            $product['gateway'] = $request->meter;
            $product['method'] = $request->type;
            $product['details'] = $request->name . " (Meter Number: " . $request->meternumber . ")";
            $product['account_number'] = $request->meternumber;
            $product['ref'] = $result['orderid'];
            $product['pin'] = $result['metertoken'];
            $product['serial'] = $result['metertoken'];
            $product['unit'] = 1;
            $product['type'] = 4; //check this if it is correct by you
            $product['remark'] = "Meter payment was successful";
            $product['trx'] = $trx;
            $product['status'] = 1;
            $product['amount'] = $request->amount;
            Transaction::create($product);


            $user = Auth::user();
            $user->balance = $user->balance - $total;
            $user->save();

            $this->sendnotification(Auth::id(), "Meter Payment", "Meter payment was successful on ". $request->meternumber. " with token: ".$product['pin']);

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
            CURLOPT_POSTFIELDS =>"{\n    \"reference\": \"$trx\",\n    \"amount\": \"$request->amount\",\n    \"narration\": \"$request->narration\",\n    \"craccountname\": \"$user->fname $user->lname\",\n    \"bankname\": \"$user->bank\",\n    \"draccountname\": \"$user->fname $user->lname\",\n    \"craccount\": \"$user->accountno\",\n    \"bankcode\": \"$user->bankcode\"\n}",
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
        }else{
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

            $this->sendnotification($user->id,"Payment Sent","Your payment to ". $name." will be sent soon." );

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

            $this->sendnotification($user->id,"Payment Sent","Your payment has been sent successfully to " . $r->fname . " ". $r->lname );

            $this->sendnotification($r->id,"Payment Received","A payment of " . $amount ." has been received from " . $user->fname . " ". $user->lname );


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
            'currencyid' => 'required',
            'usd' => 'required',
            'wallet' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }



        $auth = Auth::user();
        $basic = GeneralSettings::first();
        $currency = Currency::find($input['currencyid']);
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
        Trx::create($buy);

        return response()->json(['status' => 1, 'message' => 'Transaction is successful']);

    }

    public function sellcrypto(Request $request)
    {

        $user = Auth::user();

        $input = $request->all();
        $rules = array(
            'currencyid' => 'required',
            'usd' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $auth = Auth::user();
        $basic = GeneralSettings::first();
        $currency = Currency::find($input['currencyid']);
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

        Trx::create($buy);

        $basic = GeneralSettings::first();
        if($currency->id==5){
            $akey=$basic->bitcoin_address;
        }elseif($currency->id==1){
            $akey=$basic->etherum_address;
        }else{
            return response()->json(['status' => 1, 'message' => 'Transaction logged successfully', 'trx'=> $trx]);
        }


		$baseurl = "https://coinremitter.com/api/v3/".$currency->symbol."/create-invoice";
//        $baseurl = "https://coinremitter.com/api/v3/TCN/create-invoice";
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
            CURLOPT_POSTFIELDS => array('api_key' => $akey,'password' => 'visionxcrypto','amount' => $buy['amount'],'name' => $buy['trx'],'currency' => 'USD','expire_time' => '15', 'suceess_url' => url("/api/sellcallback")),
        ));

        $response = curl_exec($curl);
        $reply = json_decode($response,true);

        $address = $reply['data']['address'];
//        $btcvalue = $reply['data']['total_amount']['TCN'];
        if($currency->symbol=="BTC") {
            $btcvalue = $reply['data']['total_amount']['BTC'];
        }else{
            $btcvalue = $reply['data']['total_amount']['ETH'];
        }

        return response()->json(['status' => 1, 'message' => 'Transaction logged successfully', 'address'=>$address, 'btcvalue'=>$btcvalue, 'trx'=> $trx]);

    }

    public function addcoinlock(Request $request)
    {
        $user = Auth::user();

        $input = $request->all();
        $rules = array(
            'amount' => 'required',
            'duration' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }


        $count =  Vxvault::whereUser_id(Auth()->user()->id)->whereStatus(1)->where('paid', '!=', 1)->count();
        if($count > 2){
            return response()->json(['status' => 3, 'message' => 'Sorry, you cant lock more than 3 assets at a time in your VX vault. Please wait till one or more of your assets expures']);
        }
        $basic = GeneralSettings::first();
        $akey=$basic->bitcoin_address;
        $baseurl = "https://coinremitter.com/api/v3/BTC/create-invoice";
        $trx = rand(000000, 999999) . rand(000000, 999999);
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
            CURLOPT_POSTFIELDS => array('api_key' => $akey, 'password' => 'visionxcrypto', 'amount' => $request->amount, 'name' => $trx, 'currency' => 'USD', 'expire_time' => '15', 'suceess_url' => url("/api/sellcallback")),
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

        Vxvault::create($lock);

        return response()->json(['status' => 1, 'message' => 'Transaction logged successfully', 'address'=>$address, 'btcvalue'=>$btcvalue, 'trx'=> $trx]);
    }

    public function coinlockwithdraw(Request $request)
    {
        $user = Auth::user();

        $input = $request->all();
        $rules = array(
            'wallet' => 'required',
            'code' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $basic = GeneralSettings::first();
        $data = Vxvault::where('status', 1)->where('code', $request->code)->first();
        $auth = Auth::user();

        if(!$data){
            return response()->json(['status' => 0, 'message' => 'Sorry, there is no VX Vault with this transaction details. Please check and try again later']);
        }
        $data->save();

        if(Carbon::Now() < $data->expire){
            return response()->json(['status' => 0, 'message' => 'Your VX Vault is not mature enough for withdrawal. Please try again later']);
        }
        if($data->status > 1){
            return response()->json(['status' => 0, 'message' => 'You have already made withdrawal from this vault. Please create a new vault and come back later for withdrawal']);
        }

        if($data->status < 1){
            return response()->json(['status' => 0, 'message' => 'It seems you have not made any payment into your VX vault. Please check and try again later']);
        }


        $akey=$basic->bitcoin_address;

        $baseurl = "https://coinremitter.com/api/v3/BTC/get-invoice";
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
            CURLOPT_POSTFIELDS => array('api_key' => $akey, 'password' => 'visionxcrypto', 'invoice_id' => $data->invoiceid),
        ));

        $response = curl_exec($curl);
        $reply = json_decode($response, true);
        curl_close($curl);

        if (!isset($reply['data']['status_code'])) {
            return response()->json(['status' => 0, 'message' => 'An error occur. Contact server admin']);
        }
        //return $response;

        $status = $reply['data']['status_code'];

        if ($status == 0) {
            return response()->json(['status' => 0, 'message' => 'We have not received your payment for this VX vault. Ensure you have made payment before you proceed with withdrawal']);
        }
        if ($status == 4) {
            return response()->json(['status' => 0, 'message' => 'This VX vault transaction has expired on the blockchain network and it appeared you havent made any payment or locked any actual coin. Please contact admin for support or clarification.']);
        }


        if ($status == 1 || $status == 3) {
            $basic = GeneralSettings::first();
            $data->status = 2;
            $data->save();

            $withdraw['user_id'] = Auth::id();
            $withdraw['invoiceid'] = $data->invoiceid;
            $withdraw['address'] = $request->wallet;
            $withdraw['status'] = 0;
            $withdraw['code'] = $data->code;

            $dat = Vxvaultwithdraw::create($withdraw)->code;

            Message::create([
                'user_id' =>  Auth::id(),
                'title' => 'VX Vault Withdrawal Successful',
                'details' => 'Your bitcoin lock with transaction number ' . $data->code . '  has been successfully withdrawn from your vault. Please wait while we process your withdrawal, your fund will be available to you in less than 24hours Thank you for choosing ' . $basic->sitename . '',
                'admin' => 1,
                'status' => 0
            ]);

            return response()->json(['status' => 1, 'message' => 'Your Bitcoin Lock with transaction number ' . $data->code . '  was successfully withdrawn.']);
        }

    }

    public function relockcoin(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'code' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $data = Vxvault::whereUser_id(Auth()->user()->id)->whereCode($request->code)->orderBy('id','desc')->first();

        $now = Carbon::now();
        $expire = Carbon::parse($now)->addMonth(1);
        $data->expire = $expire;
        $data->save();

        return response()->json(['status' => 1, 'message' => 'You have successfully relocked your vault with Vault Number '.$data->code.'. Your fund will be available for withdrawal in the next '.$request->months.' months']);
    }

    public function sendnotification($id, $title, $message){
        Message::create([
            'user_id' => $id,
            'title' => $title,
            'details' =>$message,
            'admin' => 1,
            'status' =>  0
        ]);
    }


}
