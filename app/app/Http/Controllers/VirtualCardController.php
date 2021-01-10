<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Currency;
use App\Deposit;
use App\PaymentMethod;
use App\Gateway;
use App\GeneralSettings;
use App\SellMoney;
use App\Trx;
use App\Power;
use App\Internet;
use App\Sms;
use App\Verification;
use App\VirtualCard;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Session;
use Image;

use Validator,Redirect,Response;
use App\Network;
use App\Transaction;

class VirtualCardController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(){

		$data['page_title'] = "Virtual Card";

        return view('user.visionxcardnew', $data);
    }

    public function create(Request $request){
        $input=$request->all();

        $request->validate([
            'name' => 'required',
            'amount' => 'required|integer|min:1',
            'country' => 'required',
//
        ], [
            'name.required' => 'Please enter your full name',
            'address.required' => 'Please enter your billing address',
            'city.required' => 'Please enter your city address',
            'state.required' => 'Please enter your state address',
            'postal_code.required' => 'Please enter your postal code',
            'country.required' => 'Please enter your country',
            'amount.required' => 'Please enter your country',
        ]);

        $user = Auth::user();
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
            return back()->with("danger", "Insufficient wallet balance. Please deposit more fund and try again");
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

            return redirect('/user/visionxcard')->with('success', 'Virtual card created successfully.');
        }else{
            return back()->with("danger", "Server Error. Please try again or contact the admin");
        }


    }

    public function show(){
        $data['cards']=VirtualCard::where('user_id', Auth::id())->get();
        $data['i']=1;

		$data['page_title'] = "Virtual Card";

        return view('user.visionxcardnew', $data);
    }


    public function delete(Request $request){
        $card=VirtualCard::find($request->id);

        if(!$card){
            return back()->with("danger", "Card does not exist");
        }

        if($card->user_id != Auth::id()){
            return back()->with("danger", "Card does not exist");
        }

        if($card->status == "terminated"){
            return back()->with("danger", "Card already terminated");
        }

        $basic = GeneralSettings::first();
        $user = Auth::user();

        if ($user->withdrawpass != $request->password) {
            $user = Auth::user();
            $user->withdrawpass_used = $user->withdrawpass_used + 1;
            $user->save();


            if ($user->withdrawpass_used > 2) {
                $user->locked = 1;
                $user->save();
            }

            return back()->with('alert', 'You have entered a wrong withdraw pin. Please try again.');
        }

        if ($basic->card_terminate_charges > $user->balance) {
            return back()->with("danger", "Insufficient wallet balance. Please deposit more fund and try again");
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
            return redirect('/user/visionxcard')->with('success', 'Virtual card terminated successfully.');
        }else{
            return back()->with("danger", "Server Error. Please try again or contact the admin");
        }
    }


    public function fund(Request $request){
        $input=$request->all();
        $card=VirtualCard::find($request->id);
        $user=Auth::user();
        $basic = GeneralSettings::first();

        if ($user->withdrawpass != $request->password) {
            $user = Auth::user();
            $user->withdrawpass_used = $user->withdrawpass_used + 1;
            $user->save();


            if ($user->withdrawpass_used > 2) {
                $user->locked = 1;
                $user->save();
            }

            return back()->with('alert', 'You have entered a wrong withdraw pin. Please try again.');
        }

        if(!$card){
            return back()->with("danger", "Card does not exist");
        }

        if($card->user_id != Auth::id()){
            return back()->with("danger", "Card does not exist");
        }

        if($card->status == "terminated"){
            return back()->with("danger", "Card already terminated");
        }

        if($card->currency=="NGN"){
            $da=$input['amount'];
        }else{
            $da=$input['amount'] * $basic->dollar_rate;
        }

        if ($da > $user->balance ) {
            return back()->with("danger", "Insufficient wallet balance. Please deposit more fund and try again");
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
            $product['amount'] = $da;

            Transaction::create($product);

            $user->balance = $user->balance - $da;
            $user->save();

            $card->amount=$card->amount+$input['amount'];
            $card->save();
            return redirect('/user/visionxcard')->with('success', 'Fund of '.$input['amount'].' has been added successfully.');
        }else{
            return back()->with("danger", "Server Error. Please try again or contact the admin");
        }

    }


    public function carddetails($id){
        $card=VirtualCard::find($id);


        if(!$card){
            return response()->json(['status' => 0, 'message' => 'Card does not exist']);
        }

        if($card->user_id != Auth::id()){
            return response()->json(['status' => 0, 'message' => 'Card does not exist']);
        }

        if($card->status == "terminated"){
            return response()->json(['status' => 0, 'message' => 'Card already terminated']);
        }

        return response()->json(['status' => 1, 'message' => 'Cards fetched successfully', 'data'=>$card]);
    }

    public function cardtransactions($id){

        $card=VirtualCard::find($id);
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

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $basic->	flutterwave_url."/virtual-cards/".$card->card_id."/transactions?from=2019-01-01&to=".Carbon::now()->format('Y-m-d')."&index=0&size=5",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $basic->flutterwave_seckey"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $res=json_decode($response, true);

        if($res['status']=="success") {
            if($res['data']!="[]") {
                return response()->json(['status' => 1, 'message' => 'Card transactions fetched successfully', 'data' => $res['data']]);
            }else{
                return response()->json(['status' => 0, 'message' => $res['message']]);
            }
        }else{
            return response()->json(['status' => 0, 'message' => $res['message']]);
        }

    }



}
