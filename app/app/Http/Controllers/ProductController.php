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

class ProductController extends Controller
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



  public function products()
    {
        $user = Auth::user();
		$data['networks'] = Network::whereStatus(1)->get();
		$data['power'] = Power::whereStatus(1)->get();
        $data['page_title'] = "Products";
        return view('user.products', $data);
    }

  public function airtime()
    {
        $user = Auth::user();

        $data['page_title'] = "Airtime Recharge";
		 $data['networks'] = Network::whereStatus(1)->get();
		 $data['transactions'] = Transaction::whereStatus(1)->where('user_id', Auth::id())->latest()->whereType(1)->get();
        return view('user.rubies.airtime', $data);
    }

  public function loadairtime(Request $request)
    {
        $user = Auth::user();
	   $request->validate([
            'network' => 'required',
            'number' => 'required',
            'password' => 'required',
            'amount' => 'required|integer|min:100',
//
        ], [
            'password.required' => 'Please enter your transaction password',
            'number.required' => 'Please enter your mobile phone number',
            'network.required' => 'Please select a mobile network',
            'amount.required' => 'Please enter an amount to buy',
        ]);

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

		   if ($request->amount > $user->balance) {
             return back()->with("danger", "Insufficient wallet balance. Please deposit more fund and try again");
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

	if($rep['responsecode'] == 00)
	{
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

        return back()->with(['modal'=> 'airtime', 'success'=> 'Airtime Purchase of '.$basic->currency_sym.''.$request->amount.' was successful.']);
    }
	return back()->with("danger", "We cant process your request at the moment. Please try again later");
	}



	public function internet()
    {
        $user = Auth::user();

		$basic = GeneralSettings::first();
		 $curl = curl_init();

		  curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://openapi.rubiesbank.io/v1/ctmobiledataproduct",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS =>"{\n    \"request\": \"dataproduct\"\n}",
		  CURLOPT_HTTPHEADER => array(
			"Authorization: ".$basic->rubies_secretkey,
			": "
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$rep=json_decode($response, true);


		foreach($rep['MTN'] as $data) {
		$exist = Internet::where('code', $data['productcode'])->count();
		if($exist == 0)
		{
		$product['name'] = $data['name'];
		$product['amount'] = $data['amount'];
        $product['code'] = $data['productcode'];
        $product['amount'] = $data['amount'];
        $product['network'] = "MTN";
        $product['status'] = 1;
        Internet::create($product);

		}}

		foreach($rep['9MOBILE'] as $data) {
		$exist = Internet::where('code', $data['productcode'])->count();
		if($exist == 0)
		{
		$product['name'] = $data['name'];
		$product['amount'] = $data['amount'];
        $product['code'] = $data['productcode'];
        $product['amount'] = $data['amount'];
        $product['network'] = "9MOBILE";
        $product['status'] = 1;
        Internet::create($product);

		}}

		foreach($rep['AIRTEL'] as $data) {
		$exist = Internet::where('code', $data['productcode'])->count();
		if($exist == 0)
		{
		$product['name'] = $data['name'];
		$product['amount'] = $data['amount'];
        $product['code'] = $data['productcode'];
        $product['amount'] = $data['amount'];
        $product['network'] = "AIRTEL";
        $product['status'] = 1;
        Internet::create($product);

		}}

		foreach($rep['GLO'] as $data) {
		$exist = Internet::where('code', $data['productcode'])->count();
		if($exist == 0)
		{
		$product['name'] = $data['name'];
		$product['amount'] = $data['amount'];
        $product['code'] = $data['productcode'];
        $product['amount'] = $data['amount'];
        $product['network'] = "GLO";
        $product['status'] = 1;
        Internet::create($product);

		}}

         $data['networks'] = Network::whereStatus(1)->get();

        $data['page_title'] = "Internet Data";

		 $data['transactions'] = Transaction::whereStatus(1)->where('user_id', Auth::id())->latest()->whereType(2)->get();

		$data['mtn'] = $rep['MTN'];
		$data['airtel'] = $rep['AIRTEL'];
		$data['glo'] = $rep['GLO'];
		$data['ninemobile'] = $rep['9MOBILE'];

        return view('user.rubies.internet', $data);
    }


		 public function loadata(Request $request)
    {
        $user = Auth::user();
	   $request->validate([
            'network' => 'required',
            'number' => 'required',
        ], [
            'number.required' => 'Please enter your mobile phone number',
            'network.required' => 'Please select a mobile network',
        ]);

        	Session::put('number', $request->number);
			Session::put('network', $request->network);
			return redirect()->route('internetstep2');

    }


		public function internetstep2()
		{

        $data['page_title'] = "Internet Data";
		$data['number'] = Session::get('number');
		$network = Session::get('network');
		$data['network'] = Network::whereCode($network)->first();
		$data['plan'] = Internet::whereNetwork($network)->get();
	    return view('user.rubies.internetstep2', $data);
		}


  public function loadata2(Request $request)
    {
        $user = Auth::user();
	   $request->validate([
            'plan' => 'required',
            'number' => 'required',
            'password' => 'required',
//
        ], [
            'password.required' => 'Please enter your transaction password',
            'number.required' => 'Please enter your mobile phone number',
            'plan.required' => 'Please select an internet data plan',
        ]);


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

		if ($request->amount > $user->balance) {
             return back()->with("danger", "Insufficient wallet balance. Please deposit more fund and try again");
        }

		$trx = strtoupper(str_random(20));
		$basic = GeneralSettings::first();


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

	session()->forget('number');
	session()->forget('network');

    return redirect()->route('products')->with(['modal'=> 'airtime', "success" => "internet subscription was successful"]);
	}
	else{
		return back()->with('danger', 'Sorry, you cant subscribe to internet data at the moment, please try again later.');
	}

    }




	public function banktransfer()
    {
        $user = Auth::user();

        if($user->bankyes != 1){
        return redirect()->route('verification')->with("danger", "Please setup your payment bank account first before you proceed with bank transfer");
        }

        $data['page_title'] = "Bank Tranfer";
		 $basic = GeneralSettings::first();
		 $curl = curl_init();

		  curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://openapi.rubiesbank.io/v1/banklist",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS =>"{\n    \"request\": \"banklist\"\n}",
		  CURLOPT_HTTPHEADER => array(
			"Authorization: ".$basic->rubies_secretkey,
			"Content-Type: application/json"
		  ),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		$data['rep'] =json_decode($response, true);
		$data['transferlog'] = Transaction::where('user_id', Auth::id())->orderBy('id', 'desc')->whereType(5)->paginate(6);
		$data['totaltransfer'] = Transaction::whereStatus(1)->where('user_id', Auth::id())->whereType(5)->sum('amount');
		$data['lasttransfer'] = Transaction::whereStatus(1)->where('user_id', Auth::id())->whereType(5)->orderBy('id','Desc')->first();

		return view('user.rubies.transfer', $data);
    }


	public function validatebank(Request $request)
    {
	   $user = Auth::user();
	   $basic = GeneralSettings::first();
	  // $request->validate([
      //      'bank' => 'required',
       //     'number' => 'required',
     //       'amount' => 'required',
//
      //  ], [
      //      'bank.required' => 'Please select bank name',
     //       'amount.required' => 'Please enter amount to transfer',
     //       'number.required' => 'Please enter account number',
    //    ]);

            $total = $basic->transcharge + $request->amount;
		   if ($total > $user->balance) {
             return back()->with("danger", "Insufficient wallet balance. Please deposit more fund and try again");
           }


     if($request->bank == 'others'){
         Session::put('amount', $request->amount);
        return redirect()->route('otherbanktransfer')->with("success", "Please enter the bank details of the receiver of fund and click on proceed button when done");
        }



     $curl = curl_init();

	  curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://openapi.rubiesbank.io/v1/nameenquiry",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS =>"{\n\t\t\"accountnumber\":\"$user->accountno\",\n\t\t\"bankcode\":\"$user->bankcode\"\n}",
	  CURLOPT_HTTPHEADER => array(
		"Authorization: ".$basic->rubies_secretkey,
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	$rep=json_decode($response, true);

	if($rep['responsecode'] == 00)
	{
	//Session::put('bank', $request->bankname);
	//Session::put('code', $request->bank);
	//Session::put('name', $rep['accountname']);
	//Session::put('amount', $request->amount);
	//Session::put('number', $request->number);


	Session::put('bank', $user->bank);
	Session::put('code', $user->bankcode);
	Session::put('name', $rep['accountname']);
	Session::put('amount', $request->amount);
	Session::put('number', $user->accountno);
	return redirect()->route('validatedbank');

	}
	elseif($rep['responsecode'] == 11){
		return back()->with('danger', ' Sorry, Account Number Not Valid.');
	}
	else{
		return back()->with('danger', 'Sorry, We cannot process this transfer at the moment, please try again later.');
	}

    }

	public function validatedbank(Request $request)
    {

    $data['page_title'] = "Bank Tranfer";
	$data['bank'] = Session::get('bank');
	$data['name'] = Session::get('name');
	$data['amount'] = Session::get('amount');
	$data['number'] = Session::get('number');
	$data['code'] = Session::get('code');
	return view('user.rubies.transfersend', $data);
	}

	public function otherbanktransfer(Request $request)
    {

    $data['page_title'] = "Other Bank Tranfer";
	$data['amount'] = Session::get('amount');
	$basic = GeneralSettings::first();
		 $curl = curl_init();

		  curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://openapi.rubiesbank.io/v1/banklist",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS =>"{\n    \"request\": \"banklist\"\n}",
		  CURLOPT_HTTPHEADER => array(
			"Authorization: ".$basic->rubies_secretkey,
			"Content-Type: application/json"
		  ),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		$data['rep'] =json_decode($response, true);
	return view('user.rubies.otherbank', $data);
	}



	public function completebanktransfer(Request $request)
    {
       $user = Auth::user();
	   $request->validate([
            'password' => 'required',
            'naration' => 'required',
//
        ], [
            'password.required' => 'Please enter your transaction password',
            'naration.required' => 'Please enter transfer naration',
        ]);

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

            $basic = GeneralSettings::first();
            $total = $basic->transcharge + $request->amount;
		   if ($request->amount > $user->balance) {
             return back()->with("danger", "Insufficient wallet balance. Please deposit more fund and try again");
        }

		$trx = strtoupper(str_random(20));


	$bank = Session::get('bank');
	$name = Session::get('name');
	$amount = Session::get('amount');
	$number = Session::get('number');
	$code = Session::get('code');
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
	  CURLOPT_POSTFIELDS =>"{\n    \"reference\": \"$trx\",\n    \"amount\": \"$amount\",\n    \"narration\": \"$request->naration\",\n    \"craccountname\": \"$name\",\n    \"bankname\": \"$bank\",\n    \"draccountname\": \"$user->fname $user->lname\",\n    \"craccount\": \"$number\",\n    \"bankcode\": \"$code\"\n}",
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
    $product['gateway'] = $bank;
    $product['method'] = $name;
    $product['account_number'] = $number;
    $product['type'] = 5;
    $product['remark'] = $rep['nibssresponsemessage'];
    $product['trx'] = $trx;
    $product['status'] = 1;
    $product['amount'] = $amount;
    Transaction::create($product);


	 $user = Auth::user();
     $user->balance = $user->balance - $total;
     $user->save();


	session()->forget('bank');
	session()->forget('name');
	session()->forget('number');
	session()->forget('amount');

	return redirect()->route('products')->with(['modal'=> 'banktransfer', 'success'=> 'fund transfer was successful']);
	}
	else{
		return back()->with('danger', ''.$rep['responsecode'].'Sorry, you cant make transfer at the moment, please try again later.');
	}

    }

	public function completeotherbanktransfer(Request $request)
    {
       $user = Auth::user();
	   $request->validate([
            'password' => 'required',
            'bank' => 'required',
            'accountnumber' => 'required',
            'accountname' => 'required',
            'naration' => 'required',
//
        ], [
            'password.required' => 'Please enter your transaction password',
            'naration.required' => 'Please enter transfer naration',
            'bank.required' => 'Please select bank',
            'accountname.required' => 'Please enter account name',
            'accountnumber.required' => 'Please enter account number',
        ]);

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

            $basic = GeneralSettings::first();
            $total = $basic->transcharge + Session::get('amount');

		   if ($total > $user->balance) {
             return back()->with("danger", "Insufficient wallet balance. Please deposit more fund and try again");
        }

		$trx = strtoupper(str_random(20));
		$basic = GeneralSettings::first();

	$bank = $request->bank;
	$name = $request->accountname;
	$amount = Session::get('amount');
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

	session()->forget('amount');

	return redirect()->route('products')->with(['modal'=> 'airtime', 'fundsent'=> 'fund transfer was successful. Please wait while we process your transfer']);
	}
	else{
		return back()->with('danger', 'Sorry, you cant make transfer at the moment, please try again later.');
	}

    }

     public function cabletv()
    {
        $user = Auth::user();

        $data['page_title'] = "Pay Bills";
		 $data['networks'] = Network::whereStatus(1)->get();
		 $data['dstv'] = Transaction::whereStatus(1)->where('user_id', Auth::id())->whereType(3)->whereGateway('dstv')->sum('amount');
		 $data['gotv'] = Transaction::whereStatus(1)->where('user_id', Auth::id())->whereType(3)->whereGateway('gotv')->sum('amount');
		 $data['startimes'] = Transaction::whereStatus(1)->where('user_id', Auth::id())->whereType(3)->whereGateway('startimes')->sum('amount');
		 $data['cabletv'] = Transaction::whereStatus(1)->where('user_id', Auth::id())->whereType(3)->paginate(6);
        return view('user.clubkonnect.cabletv', $data);
    }


     public function validatedecoder(Request $request)
    {
         $user = Auth::user();
	     $request->validate([
            'decodertype' => 'required',
            'decodernumber' => 'required',
//
        ], [
            'decodertype.required' => 'Please select a decoder type',
            'decodernumber.required' => 'Please enter a decoder number',
        ]);

		$basic = GeneralSettings::first();
         $baseUrl = "https://www.nellobytesystems.com";
        $endpoint = "/APIVerifyCableTVV1.0.asp?UserID=".$basic->clubkonnect_id."&APIKey=".$basic->clubkonnect_key."&cabletv=".$request->decodertype."&smartcardno=".$request->decodernumber."";

        $url=$baseUrl.$endpoint;
        // Perform initialize to validate name on server
        $result = file_get_contents($url);

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


			 if ($result == "PACKAGE_NOT_AVAILABLE"){
			       return back()->with('danger', 'Your slected subscription plan is not available at the moment. Please Try Again');

        	    }
		     if ($result == "INVALID_SMARTCARDNO"){
		      return back()->with('danger', 'You have entered an invalid decoder/smart card number. Please Try Again');


        	    }
		     if ($result == "INVALID_CREDENTIALS"){
		      return back()->with('danger', 'INVALID API KEY. Please Try Again');

    	    }
    	     if ($result == ""){
			       return back()->with('danger', 'We are unable to process your request at the moment. Please Try Again');

        	 }


			Session::put('number', $request->decodernumber);
			Session::put('decoder', $request->decodertype);
			Session::put('deco', $request->deco);
			Session::put('name', $result);
			return redirect()->route('validateddecoder');


		}

		public function validateddecoder(Request $request)
		{

		$data['page_title'] = "Select Bouquet";
		$data['decoder'] = Session::get('decoder');
		$data['number'] = Session::get('number');
		$data['name'] = Session::get('name');
		$data['deco'] = Session::get('deco');


		$baseUrl = "https://www.nellobytesystems.com";
        $endpoint = "/APICableTVPackagesV2.asp";

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

			$data['plans'] = $content['TV_ID'];
		    return view('user.clubkonnect.tvsubscribe', $data);
		}


		public function paydecoder(Request $request)
    {
       $user = Auth::user();
	   $request->validate([
            'password' => 'required',
            'package' => 'required',
//
        ], [
            'password.required' => 'Please enter your transaction password',
            'package.required' => 'Please select a bouquet',
        ]);

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
        	$basic = GeneralSettings::first();

		   if ($request->amount + $basic->decoderfee > $user->balance) {
             return back()->with("danger", "Insufficient wallet balance. Please deposit more fund and try again");
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


                session()->forget('deco');
                session()->forget('name');
                session()->forget('number');
                session()->forget('decoder');

                return redirect()->route('products')->with(['modal'=> 'tv', "success"=> $product['remark']]);

        }else {
            return back()->with('danger', 'We cannot proces your selected subscription plan at the moment. Please Try Again');
        }

//			if($content['status'] == "INSUFFICIENT_BALANCE") {
//             session()->flash('alert', 'Merchant API Doesnt Have Enough Fund To Service Your Request. No fund deducted from your wallet');
//
//            return redirect()->route('home');
//
//	    	}
//
//	        if($content['status'] == "PACKAGE_NOT_AVAILABLE"){
//			       return back()->with('danger', 'Your selected subscription plan is not available at the moment. Please Try Again');
//
//        	 }
//
//
//	        if($content['status'] == ""){
//			       return back()->with('danger', 'We cannot proces your selected subscription plan at the moment. Please Try Again');
//
//        	 }
//			 $trx = strtoupper(str_random(20));
//			 if($content['status'] == "ORDER_RECEIVED")
//			{
//			$product['user_id'] = Auth::id();
//			$product['gateway'] = $request->decoder;
//			$product['method'] = $request->package;
//			$product['account_number'] = $request->number;
//			$product['type'] = 3;
//			$product['remark'] = "TV Subscription was successful on ".$request->decoder." ".$request->package." bouquet";
//			$product['trx'] = $trx;
//			$product['status'] = 1;
//			$product['amount'] = $request->amount;
//			Transaction::create($product);
//
//
//			 $user = Auth::user();
//			 $total = $amount - 100;
//			 $user->balance = $user->balance - $total;
//			 $user->save();
//
//
//			session()->forget('deco');
//			session()->forget('name');
//			session()->forget('number');
//			session()->forget('decoder');
//
//			return redirect()->route('home')->with("success", "fund transfer was successful");
//			}
//			else{
//				return back()->with('danger', ''.$rep['responsecode'].'Sorry, you cant make transfer at the moment, please try again later.');
//			}
//
//

    }



     public function utilitybills()
    {
        $user = Auth::user();

        $data['page_title'] = "Utility Bills";
		 $data['power'] = Power::whereStatus(1)->get();
		 $data['powered'] = Transaction::whereStatus(1)->where('user_id', Auth::id())->whereType(4)->latest()->get();
		 $data['sum'] = Transaction::whereStatus(1)->where('user_id', Auth::id())->whereType(4)->sum('amount');
		 $data['count'] = Transaction::whereStatus(1)->where('user_id', Auth::id())->whereType(4)->count();
        return view('user.rubies.power', $data);
    }


	public function validatemeter(Request $request)
		{

		 $user = Auth::user();
	   $request->validate([
            'meternumber' => 'required',
            'meter' => 'required',

        ], [
            'meter.required' => 'Please select your service provider',
            'meternumber.required' => 'Please enter a meter number',
        ]);



		$basic = GeneralSettings::first();

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://openapi.rubiesbank.io/v1/billerverification",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS =>"{\n    \"billercode\":\"$request->meter\",\n    \"billercustomerid\":\"$request->meternumber\"\n}",
          CURLOPT_HTTPHEADER => array(
            "Authorization: ".$basic->rubies_secretkey
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result =json_decode($response, true);

        if(isset($result['message'])){
         return back()->with('danger', 'it seems you have entered a wrong meter number or you have selected a wrong meter. Please check and try again');
        }

        if(isset($result['responsecode'])){
        if($result['responsecode'] == 00){
          Session::put('number', $request->meternumber);
          Session::put('meter', $request->meter);
          Session::put('name', $result['customername']);
          return redirect()->route('validatedmeter');
        }
        else{
           return back()->with('danger', 'We cannot process your request at the moment, please try again later');
            }
        }


		}


		public function validatedmeter(Request $request)
		{

		$data['page_title'] = "Enter Amount";
		$data['meter'] = Session::get('meter');
		$data['number'] = Session::get('number');
		$data['name'] = Session::get('name');
		$data['mtype'] = Power::whereBillercode($data['meter'])->first()->type;
		if($data['mtype'] = "Prepaid"){
		$data['type'] = "PREPAID";
		}
		else{
		$data['type'] = "POSTPAID";
		}



	    return view('user.rubies.paypower', $data);
		}

    public function paypower(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'password' => 'required',
            'amount' => 'required|integer|min:100',
//
        ], [
            'password.required' => 'Please enter your transaction password',
            'amount.required' => 'Please enter an amount',
        ]);

        if ($user->withdrawpass != $request->password) {
            $user = Auth::user();
            $user->withdrawpass_used = $user->withdrawpass_used + 1;
            $user->save();


		    if ($user->withdrawpass_used > 2) {
		    $user->locked = 1;
            $user->save();
		    }

            return back()->with('alert', 'You have entered a wrong transaction pin. Please try again.');
        }
        $power = Power::whereStatus(1)->whereBillercode($request->meter)->first();
        $basic = GeneralSettings::first();
        $total = $basic->electricityfee + $request->amount;

        if ($total > $user->balance) {
            return back()->with("danger", "Insufficient wallet balance. Please deposit more fund and try again");
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
          CURLOPT_POSTFIELDS =>"{\n    \"reference\": \"$trx\",\n    \"billercustomerid\": \"$request->number\",\n    \"productcode\": \"$request->type\",\n    \"amount\": \"$request->amount\",\n    \"mobilenumber\": \"08031975397\",\n    \"name\": \"$request->name\",\n    \"billercode\": \"$request->meter\"\n}",
          CURLOPT_HTTPHEADER => array(
            "Authorization: ".$basic->rubies_secretkey
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result =json_decode($response, true);

        if(isset($result['message'])){
         return back()->with('danger', $result['message']);
        }


        if($result['responsecode'] == 00){
         $product['user_id'] = Auth::id();
            $product['gateway'] = $request->meter;
            $product['method'] = $request->type;
            $product['details'] = $request->name." (Meter Number: ".$request->number.")";
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

            return redirect()->route('products')->with(['modal'=> 'power', "success"=> $product['remark']]);
        }
        else{
           return back()->with('danger', 'We cannot process your request at the moment, please try again later');
            }

    }

    	public function instantsms()
		{

		$data['page_title'] = "Instant SMS";
		$data['sms'] = Sms::where('user_id', Auth::id())->latest()->get();
		$data['sum'] = Sms::where('user_id', Auth::id())->sum('amount');
		$data['count'] = Sms::where('user_id', Auth::id())->count();
	    return view('user.bulksms.index', $data);
		}



		 public function sendsmsnow(Request $request)
    {

     $request->validate([
            'message' => 'required|string|max:160',
            'phone' => 'required|string|max:11',
            ]);

        $user = Auth::user();




        $basic = GeneralSettings::first();
         if ($user->balance < $basic->smscharge) {
            return back()->with('alert', 'Your wallet balance is low. You cant send sms at the moment.');
        }



            $message = utf8_encode(urlencode($request->message));
        	 $baseUrl = "https://www.bulksmsnigeria.com/";
            $endpoint = "api/v1/sms/create?api_token=".$basic->sms_token."&from=SMS&to=".$request->phone."&body=".$message."";
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
            $trr =Sms::create($w);




        $user->balance = $user->balance - $basic->smscharge;
        $user->save();

         return back()->with(['modal'=> 'tv', 'success'=> 'Message Sent To Number']);


}




}
