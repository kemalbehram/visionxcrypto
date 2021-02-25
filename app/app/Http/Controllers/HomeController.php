<?php

namespace App\Http\Controllers;

use App\Bank;
use App\BuyMoney;
use App\Currency;
use App\Deposit;
use App\ExchangeMoney;
use App\PaymentMethod;
use App\Localbank;
use App\Gateway;
use App\GeneralSettings;
use App\SellMoney;
use App\Transaction;
use App\Trx;
use App\Faq;
use App\Verified;
use App\Verification;
use App\WithdrawLog;
use App\Banky;
use App\Message;
use App\Transfer;
use App\UserLogin;
use App\Post;
use App\Testimonial;
use App\WithdrawMethod;
use Illuminate\Http\Request;
use App\Cryptowallet;
use App\Lib\coinPayments;
use App\Lib\BlockIo;
use App\Lib\CoinPaymentHosted;
use Auth;
use Mail;
use App\User;
use App\Investyield;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Session;
use Image;


use App\UserWallet;
use App\TimeSetting;
use App\Invest;
use App\Plan;

class HomeController extends Controller
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

    public function createwallet()
    {
        $token = 'v2x1c5087ffd1e3a432ef9baedc54c80c946115f1d3eb0eb6b54d8e13b67025a9b1';
        $coin = CurrencyCode::BITCOIN_TESTNET;

        $bitgo = new BitGoSDK($token, $coin, true);
        $bitgo->walletId = 'testitnow';

        $createAddress = $bitgo->createWalletAddress();
        var_dump($createAddress);

    }

    public function darkmode()
    {
        $auth = Auth::user();

        if ($auth->darkmode == 1) {
            $auth->darkmode = 0;
            $auth->save();
            return response()->json(['status' => 1, 'message' => 'Light mode activated']);
//		 return back()->withSuccess('Light mode activated');
        } else {
            $auth->darkmode = 1;
            $auth->save();
            return response()->json(['status' => 1, 'message' => 'Dark mode activated']);
//		 return back()->withSuccess('Dark mode activated');
        }

    }


    public function index()
    {
        $basic = GeneralSettings::first();

        $data['page_title'] = "Dashboard";
        $user = Auth::user();
        $data['trx'] = Trx::whereUser_id($user->id)->whereStatus(0)->latest()->paginate(6);
        $data['approved'] = Deposit::where('user_id', Auth::id())->whereStatus(1)->select('amount')->sum('amount');;
        $data['pending'] = Deposit::where('user_id', Auth::id())->whereStatus(0)->select('amount')->sum('amount');;
        $data['declined'] = Deposit::where('user_id', Auth::id())->whereStatus(-2)->select('amount')->sum('amount');;
        $data['withdraw'] = WithdrawLog::where('user_id', Auth::id())->whereStatus(2)->select('amount')->sum('amount');;
        $data['withdrawpend'] = WithdrawLog::where('user_id', Auth::id())->whereStatus(1)->select('amount')->sum('amount');;
        $data['buy'] = Trx::where('user_id', Auth::id())->whereStatus(2)->whereType(1)->select('main_amo')->sum('main_amo');;
        $data['bpend'] = Trx::where('user_id', Auth::id())->whereStatus(1)->whereType(1)->select('main_amo')->sum('main_amo');;
        $data['bcharge'] = Trx::where('user_id', Auth::id())->whereStatus(1)->whereType(1)->select('charge')->sum('charge');;
        $data['bacharge'] = Trx::where('user_id', Auth::id())->whereStatus(2)->whereType(1)->select('charge')->sum('charge');;
        $data['bdeccharge'] = Trx::where('user_id', Auth::id())->whereStatus(-2)->whereType(1)->select('charge')->sum('charge');;
        $data['bdecline'] = Trx::where('user_id', Auth::id())->whereStatus(-2)->whereType(1)->select('main_amo')->sum('main_amo');;
        $data['sell'] = Trx::where('user_id', Auth::id())->whereStatus(2)->whereType(2)->select('main_amo')->sum('main_amo');;
        $data['spend'] = Trx::where('user_id', Auth::id())->whereStatus(1)->whereType(2)->select('main_amo')->sum('main_amo');;
        $data['sdecline'] = Trx::where('user_id', Auth::id())->whereStatus(-2)->whereType(2)->select('main_amo')->sum('main_amo');;
        $data['time'] = Carbon::now();
        $data['news'] = $basic->news;
        $crypt = Currency::all();

        $user = Auth::user();
        $baseUrl = "https://blockchain.info/";
        $endpoint = "tobtc?currency=USD&value=1";
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

        $data['btcrate'] = json_decode(curl_exec($ch), true);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        curl_close($ch);
        $data['investment'] = UserWallet::where('user_id', Auth::id())->where('type', 'interest_wallet')->first();
        $data['invested'] = Invest::where('user_id', Auth::id())->sum('amount');


        foreach ($crypt as $coin) {
            $address = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890'), 0, 10);
            $exist = Cryptowallet::where('coin_id', $coin->id)->where('user_id', Auth::id())->count();
            if ($exist == 0) {

                $new['coin_id'] = $coin->id;
                $new['name'] = $coin->name;
                $new['address'] = '0';
                $new['user_id'] = Auth::id();
                $new['balance'] = '0';
                $new['status'] = '1';

                Cryptowallet::create($new);
            }
        }

        if ($basic->maintain == 1) {
            return view('front.maintain', $data);
        }

         $time = Carbon::parse(Carbon::now())->addMinutes(30);
         $user->login_time = $time;
         $user->save();



        return view('home', $data);
    }


    public function daily()
    {
        $user = Auth::user();
        $settings = GeneralSettings::first();
        $now = Carbon::now();

        if ($user->verified != 2) {
            return back()->withAlert('You are not eligible for daily bonus. Please proceed to verify your account first');
        }

        if ($user->time < $now) {

            $user->time = $now->addHours(24);
            $user->save();
            $user->bonus = $user->bonus + $settings->bonus;
            $user->save();

            return back()->withSuccess('You have Successfuly Claimed your daily ' . $settings->currency . '' . $settings->bonus . ' bonus. ');

        }

        return back()->withAlert('You have Alredy Claimed your ' . $settings->currency . '' . $settings->bonus . ' daily rewards already. Please come back tomorrow for more');

    }

    public function authCheck()
    {
        $basic = GeneralSettings::first();
        if ($basic->maintain == 1) {
            return view('front.maintain', $data);
        }


        if (Auth()->user()->status == '1' && Auth()->user()->email_verify == '1' && Auth()->user()->sms_verify == '1') {
            return redirect()->route('home');
        } else {
            $data['page_title'] = "Authorization";
            return view('user.authorization', $data);
        }
    }

    public function sendVcode(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $basic = GeneralSettings::first();
        if (Carbon::parse($user->phone_time)->addMinutes(1) > Carbon::now()) {
            $time = Carbon::parse($user->phone_time)->addMinutes(1);
            $delay = $time->diffInSeconds(Carbon::now());
            $delay = gmdate('i:s', $delay);
            session()->flash('danger', 'You can resend Verification Code after ' . $delay . ' minutes');
        } else {
            $code = strtoupper(Str::random(6));
            $user->phone_time = Carbon::now();
            $user->sms_code = $code;
            $user->save();

            $baseUrl = "https://www.bulksmsnigeria.com/";
            $endpoint = "api/v1/sms/create?api_token=" . $basic->sms_token . "&from=VISIONX&to=" . $user->phone . "&body=" . $code . "";
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

            session()->flash('success', 'Verification Code Sent successfully');
        }
        return back();
    }

    public function smsVerify(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ($user->sms_code == $request->sms_code) {
            $user->phone_verify = 1;
            $user->save();
            session()->flash('success', 'Your Phone Number has been verfied successfully');
            return redirect()->route('home');
        } else {
            session()->flash('danger', 'Verification Code Did not match');
        }
        return back();
    }

    public function bvnVerify(Request $request)
    {
        $user = Auth::user();
        $basic = GeneralSettings::first();
        $request->validate([
            'bvn' => 'required',
//
        ], [
            'number.required' => 'Please enter your bank verification number',
        ]);


        if ($basic->bvn > $user->balance) {
            return back()->with("danger", "Insufficient wallet balance. Please deposit more fund and try again");
        }


        $trx = strtoupper(str_random(20));
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://openapi.rubiesbank.io/v1/verifybvn",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\t\"bvn\":\"$request->bvn\",\n\t\"reference\":\"$trx\"\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: " . $basic->rubies_secretkey,
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $rep = json_decode($response, true);

        if ($rep['responsecode'] == 00) {

            $product['user_id'] = Auth::id();
            $product['firstName'] = $rep['firstName'];
            $product['lastName'] = $rep['lastName'];
            $product['phoneNumber'] = $rep['phoneNumber'];
            $product['gender'] = $rep['data']['gender'];
            $product['dateOfBirth'] = $rep['data']['dateOfBirth'];
            $product['base64Image'] = $rep['base64Image'];
            $product['number'] = $request->bvn;
            Verified::create($product);

            $user->bvn_verify = 1;
            $user->bvn_time = Carbon::now();
            $user->balance = $user->balance - $basic->bvn;
            $user->save();


            return back()->with(['modal' => 'bvn', 'success' => 'Bank Verification Number has been verfied successfully']);

        } else {
            session()->flash('danger', 'You Have Entered A Wrong Bank Verification Number');
        }
        return back();
    }

    public function sendEmailVcode(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if (Carbon::parse($user->email_time)->addMinutes(1) > Carbon::now()) {
            $time = Carbon::parse($user->email_time)->addMinutes(1);
            $delay = $time->diffInSeconds(Carbon::now());
            $delay = gmdate('i:s', $delay);
            session()->flash('danger', 'You can resend Verification Code after ' . $delay . ' minutes');
        } else {
            $code = strtoupper(Str::random(6));
            $user->email_time = Carbon::now();
            $user->verification_code = $code;
            $user->save();

             $data = array(

                "name"=> $user->username,
                "email"=> $user->email,
                "body"=> "Your Verification Code is " . $code,
                "heading"=> "Verification Code",
                );



      Mail::send('mail', $data, function($message) {
      $user = Auth::user();
    $message->to($user->email, $user->username)->subject('Verification Code');
});

            send_email($user->email, $user->username, 'Verificatin Code', 'Your Verification Code is ' . $code);
            session()->flash('success', 'Verification Code Sent  successfully');
        }
        return back();
    }

    public function postEmailVerify(Request $request)
    {

        $user = User::find(Auth::user()->id);
        if ($user->verification_code == $request->email_code) {
            $user->email_verify = 1;
            $user->save();
            session()->flash('success', 'Your Profile has been verfied successfully');
            return redirect()->route('home');
        } else {
            session()->flash('danger', 'Verification Code Did not matched');
        }
        return back();
    }


    public function faqs()
    {
        $auth = Auth::user();
        $data['page_title'] = "FAQs";
        $data['faq'] = Faq::all();
        return view('user.faq', $data);
    }


    public function Profile()
    {
        $auth = Auth::user();
        $data['page_title'] = "Profile";
        $data['user'] = User::findOrFail($auth->id);
        $data['method'] = Localbank::all();
        $data['referral'] = User::whereRefer(Auth::user()->id)->get();
        return view('user.profile', $data);
    }

    public function submitProfile(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'dob' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|min:10|unique:users,phone,' . $user->id,
//
        ], [
            'fname.required' => 'First Name must not be empty',
            'lname.required' => 'Last Name must not be empty',
        ]);
        $in = Input::except('_method', '_token');
        $in['reference'] = $request->username;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $request->username . '.jpg';
            $location = 'assets/images/user/' . $filename;
            $in['image'] = $location;
            if ($user->image != 'user-default.png') {
                $path = './assets/images/user/';
                $link = $path . $user->image;
                if (file_exists($link)) {
                    @unlink($link);
                }
            }
            Image::make($image)->resize(800, 800)->save($location);
        }
        $user->fill($in)->save();
        return back()->with('success', 'Your Profile Has Been Updated Successfully.');

    }


    public function submitPassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:5|confirmed'
        ]);
        try {
            $c_password = Auth::user()->password;
            $c_id = Auth::user()->id;
            $user = User::findOrFail($c_id);
            if (Hash::check($request->current_password, $c_password)) {

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();

                return back()->with('success', 'Password Changes Successfully.');
            } else {
                return back()->with('danger', 'Current Password Not Match');
            }

        } catch (\PDOException $e) {
            return back()->with('danger', $e->getMessage());
        }
    }




    public function unlockme(Request $request)
    {
        $this->validate($request, [
            'password' => 'required'
        ]);
        try {
            $c_password = Auth::user()->password;
            $c_id = Auth::user()->id;
            $user = User::findOrFail($c_id);
            if (Hash::check($request->password, $c_password)) {

                 $time = Carbon::parse(Carbon::now())->addMinutes(30);
                $user->login_time = $time;
                $user->save();

                return back()->with('success', 'Account Unlocked Successfully.');
            } else {
                return back()->with('danger', 'Current Password Not Match');
            }

        } catch (\PDOException $e) {
            return back()->with('danger', $e->getMessage());
        }
    }

    public function changepin(Request $request)
    {
        $this->validate($request,
            [
                'newpin' => 'required|string|max:4',
                'currentpin' => 'required',
            ]);


        $user = User::findOrFail(Auth::id());

        if ($request->currentpin != $user->withdrawpass) {
            return back()->with('error', 'Currenct Withdrawal Pin Is Wrong. Please Try Again.');
        }

        $user->withdrawpass = $request->newpin;
        $user->save();

        return back()->with('success', 'Withdrawal Pin Updated Successfully.');

    }


    public function deposit(Request $request)
    {
        $data['page_title'] = " Payment Methods";
        $data['gates'] = Gateway::whereStatus(1)->whereVal7(1)->get();
        $data['deposit'] = Deposit::whereUser_id($user->id)->latest()->paginate(10);
        $data['count'] = Deposit::whereUser_id($user->id)->count();
        $data['sum'] = Deposit::whereStatus(1)->whereUser_id($user->id)->sum('amount');

        return view('user.deposit', $data);
    }


    public function activitylog()
    {
        $data['page_title'] = " Activities";
        $data['activity'] = UserLogin::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(10);
        return view('user.activity-log', $data);
    }


    public function referral()
    {
        $data['referral'] = User::whereRefer(Auth::user()->id)->get();
        $data['page_title'] = "Referral Log";
        return view('user.referral-log', $data);
    }


    public function kyc()
    {
        $data['user'] = Auth::user()->id;
        $data['kyc'] = Verification::whereUser_id(Auth::user()->id)->first();
        $data['kyccount'] = Verification::whereUser_id(Auth::user()->id)->count();
        $data['page_title'] = "Account Verification";
        $data['docs'] = Verification::where('user_id', Auth::id())->latest()->first();
        $data['kyc3a'] = Verification::where([['user_id', Auth::id()], ['type', 'Bank Statement']])->latest()->first();
        $data['kyc3b'] = Verification::where([['user_id', Auth::id()], ['type', 'Utility Bill']])->latest()->first();
        $curl = curl_init();
        $basic = GeneralSettings::first();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://openapi.rubiesbank.io/v1/banklist",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n    \"request\": \"banklist\"\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: " . $basic->rubies_secretkey,
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $rep = json_decode($response, true);
        $data['list'] = $rep['banklist'];

        curl_close($curl);
        return view('user.account-verification', $data);
    }


    public function kyc2(Request $request)
    {

        $this->validate($request,
            [
                'type' => 'required',
                'date' => 'required',
                'number' => 'required',
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'photo2' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

        $docm['user_id'] = Auth::id();
        $docm['type'] = $request->type;
        $docm['date'] = $request->date;
        $docm['number'] = $request->number;
        $docm['status'] = 0;
        if ($request->hasFile('photo')) {
            $docm['image1'] = uniqid() . '.jpg';
            $request->photo->move('kyc', $docm['image1']);
        }
        if ($request->hasFile('photo2')) {
            $docm['image2'] = uniqid() . '.jpg';
            $request->photo2->move('kyc', $docm['image2']);
        }

        Verification::create($docm);

        $user = User::find(Auth::id());
        $user['verified'] = 1;
        $user->save();


        Message::create([
            'user_id' => $user->id,
            'title' => 'KYC Submited',
            'details' => 'Your KYC submission has been received. Please wait while we verify your submissin. You will receive a message once your submission has been approved',
            'admin' => 1,
            'status' => 0
        ]);


        return back()->with(['modal' => 'kyc', 'success' => 'Account Verification Request Sent Successfully.']);


//          session()->flash('success', 'Account Verification Request Sent Successfully. ');
//
//         return redirect()->route('home');
    }

    public function kyc3(Request $request)
    {

        $this->validate($request,
            ['type' => 'required',
                'photo' => 'required',
            ]);

        $docm['user_id'] = Auth::id();
        $docm['type'] = $request->type;
        $docm['date'] = Carbon::now();
        $docm['status'] = 0;
        if ($request->hasFile('photo')) {
            $docm['image1'] = uniqid() . '.jpg';
            $request->photo->move('kyc', $docm['image1']);
        }

        Verification::create($docm);

        $user = User::find(Auth::id());
        $user['verified'] = 1;
        $user->save();


        Message::create([
            'user_id' => $user->id,
            'title' => $request->type . ' Submitted',
            'details' => 'Your KYC submission has been received. Please wait while we verify your submission. You will receive a message once your submission has been approved',
            'admin' => 1,
            'status' => 0
        ]);


        return back()->with(['modal' => 'kyc', 'success' => $request->type . ' uploaded Successfully.']);
    }


    public function bank()
    {
        $data['user'] = Auth::user()->id;
        $data['page_title'] = "Bank Account";
        return view('user.bank', $data);
    }


    public function postbank(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $gate = Gateway::whereId(107)->first();
        $bankCode = $request->bank;
        $bank = Banky::whereCode($request->bank)->first();


        if (isset($request->paypal)) {
            $user->paypal = $request->paypal;
            $user->save();
        }

        if (isset($request->btc)) {
            $user->btcwallet = $request->btc;
            $user->save();
        }

        if ($request->bank == "other") {
            $user->bank = $request->bankname;
            $user->accountname = $request->acctname;
            $user->accountno = $request->actnumber;
            $user->bankyes = 1;
            $user->save();
            return back()->with('success', 'Bank Account Updated Successfuly');
        }

        if ($request->bank == "none") {
            return back()->with('danger', 'Bank Account Not Updated');
        }

        $basic = GeneralSettings::first();
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
            CURLOPT_POSTFIELDS => "{\n\t\t\"accountnumber\":\"$request->actnumber\",\n\t\t\"bankcode\":\"$request->bank\"\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: " . $basic->rubies_secretkey,
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $rep = json_decode($response, true);

        if ($rep['responsecode']) {
            if ($rep['responsecode'] == 00) {
                $acctname = $rep['accountname'];

                $user->bank = $request->bankname;
                $user->accountname = $acctname;
                $user->bankyes = 1;
                $user->accountno = $request->actnumber;
                $user->bankcode = $request->bank;
                $user->save();

                return back()->with(['modal' => 'bank', 'success' => 'Bank Account Updated successfully']);


            }

            return back()->with('danger', 'Account Number Not Verified Successfuly. Please check the account number and try again.');


        }

    }

    public function veribank(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $gate = Gateway::whereId(107)->first();
        $bankCode = $request->bank;
        $bank = Banky::whereCode($request->bank)->first();
        $bankname = $bank->bank;

        $AccountID = "$request->accountno";
        $baseUrl = "https://api.paystack.co";
        $endpoint = "/bank/resolve?account_number=" . $AccountID . "&bank_code=" . $bankCode;
        $httpVerb = "GET";
        $contentType = "application/json"; //e.g charset=utf-8
        $authorization = "$gate->val2"; //gotten from paystack dashboard


        $headers = array(
            "Content-Type: $contentType",
            "Authorization: Bearer $authorization"
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

        if ($content['status']) {
            $response['account_name'] = $content['data']['account_name'];
            $bname = $response['account_name'];

            $user->bank = $bank->bank;
            $user->accountno = $AccountID;
            $user->accountname = $bname;
            $user->save();
            session()->flash('ready', 'Verification Code Did not matched');
            return back()->with('success', 'Account Number Is Valid');

        } else {

            return back()->with('danger', 'Account Number Not Registered With ' . $bank->bank . '');
        }


    }

    public function validatebank($id)
    {
        $user = User::whereAccountno($id)->first();
        $user->bankyes = 1;
        $user->save();
        return back()->with('success', 'Bank Details Addes Successfully');


    }


    public function depositDataInsert(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric|min:3000',
            'gateway' => 'required',
        ]);
        $basic = GeneralSettings::first();
        if ($request->amount <= 0) {
            return back()->with('danger', 'Invalid Amount Entered');
        }
        if ($request->gateway == "bank") {
            $usdamo = ($request->amount + 0) / $basic->rate;
            $depo['user_id'] = Auth::id();
            $depo['gateway_id'] = 0;
            $depo['amount'] = $request->amount;
            $depo['charge'] = $basic->depocharge;
            $depo['usd'] = round($usdamo, 2);
            $depo['trx'] = str_random(16);
            $depo['status'] = 0;
            Deposit::create($depo);

            Session::put('Track', $depo['trx']);

            return redirect()->route('user.deposit.preview');


        }

          if ($request->gateway == "bitcoin") {
            $trx = str_random(15);
            $usdamo = ($request->amount + 0) / $basic->rate;
            $usdcharge = ($basic->depocharge + 0) / $basic->rate;
            $usdconv = $usdamo + $usdcharge;
            $usd = number_format($usdconv,2);
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
                CURLOPT_POSTFIELDS => array('api_key' => $akey, 'password' => 'visionxcrypto', 'amount' => $usd, 'name' => $trx, 'currency' => 'USD', 'expire_time' => '15', 'suceess_url' => url("/noapi/sellcallback")),
            ));

            $response = curl_exec($curl);
            $reply = json_decode($response, true);
            curl_close($curl);
            //return $reply;

             if($reply['flag'] == 0){
                return back()->with('danger',$reply['msg']);
            }

            if(!isset($reply['data']['address'])){
                return back()->with('danger','Amount too low');
            }


            $address = $reply['data']['address'];
            $invoiceid = $reply['data']['invoice_id'];
            $btcvalue = $reply['data']['total_amount']['BTC'];

            $depo['user_id'] = Auth::id();
            $depo['gateway_id'] = 513;
            $depo['amount'] = $request->amount;
            $depo['code'] = $invoiceid;
            $depo['image'] =  $address;
            $depo['coin'] = $btcvalue;
            $depo['charge'] = $basic->depocharge;
            $depo['usd'] = round($usd, 2);
            $depo['trx'] = $trx;
            $depo['status'] = 0;
            Deposit::create($depo);

            Session::put('Track', $depo['trx']);

            return redirect()->route('user.deposit.preview');


        }
        else {
            $gate = Gateway::findOrFail($request->gateway);

            if (isset($gate)) {
                if ($gate->minamo <= $request->amount && $gate->maxamo >= $request->amount) {
                    $charge = $gate->fixed_charge + ($request->amount * $gate->percent_charge / 100);
                    $usdamo = ($request->amount + $charge) / $basic->rate;


                    $depo['user_id'] = Auth::id();
                    $depo['gateway_id'] = $gate->id;
                    $depo['amount'] = $request->amount;
                    $depo['charge'] = $charge;
                    $depo['usd'] = round($usdamo, 2);
                    $depo['trx'] = str_random(16);
                    $depo['status'] = 0;
                    Deposit::create($depo);

                    Session::put('Track', $depo['trx']);

                    return redirect()->route('user.deposit.preview');

                } else {
                    return back()->with('danger', 'Please Follow Deposit Limit');
                }
            } else {
                return back()->with('danger', 'Please Select Deposit gateway');
            }
        }
    }

    public function depositPreview()
    {

        $track = Session::get('Track');
        $data = Deposit::where('status', 0)->where('trx', $track)->first();
        $page_title = "Deposit Preview";
        $auth = Auth::user();
        $total = $data->charge + $data->amount;

        $baseUrl = "https://api.alternative.me";
        $endpoint = "/v2/ticker/";
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

        $rate = json_decode(curl_exec($ch), true);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        curl_close($ch);

        if ($data->gateway_id == 513) {
            $coinrate = $rate['data']['1'];
            $amount = $coinrate['quotes']['USD'];
            $rrate = $amount['price'];
            $rate = $rrate;
        }

        if ($data->gateway_id == 514) {
            $coinrate = $rate['data']['1027'];
            $amount = $coinrate['quotes']['USD'];
            $rrate = $amount['price'];
            $rate = $rrate;
        }

        if ($data->gateway_id == 102) {
            $gatewayData = Gateway::where('id', $data->gateway_id)->first();
            $perfectval = $gatewayData->val1;
        }

        return view('user.payment.preview', compact('data', 'rate', 'track', 'total', 'page_title'));
    }



    public function btcdepositcallback(Request $request, $id)
    {

        $basic = GeneralSettings::first();
        $data = Deposit::where('status', 0)->where('trx', $request->trx)->where('code', $id)->first();
        $auth = Auth::user();
        $data->save();

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
            CURLOPT_POSTFIELDS => array('api_key' => $akey, 'password' => 'visionxcrypto', 'invoice_id' => $id),
        ));

        $response = curl_exec($curl);
        $reply = json_decode($response, true);
        curl_close($curl);
        //return $response;

        if (!isset($reply['data']['status_code'])) {
            return back()->with("danger", "An error occur. Contact server admin");
        }

        $status = $reply['data']['status_code'];

        if ($status == 0) {
            return back()->with("danger", "We have not received your payment. Kindly Scan and make payment");
        }

         if ($status == 4) {
         return redirect()->route('my-wallet')->with("danger", "Transation has expired. We didnt receive any BTC. Please try again later");

        }


        if ($data->status == 1) {
            return redirect()->route('my-wallet')->with("danger", "Payment has been made already");
        }


        if ($status == 1 || $status == 3) {
            $basic = GeneralSettings::first();
            $data->status = 1;
            $data->save();

            $user = User::find($data->user_id);
            $user->balance += $data->amount;
            $user->save();

            Message::create([
                'user_id' => $data->user_id,
                'title' => 'BTC Deposit Successful',
                'details' => 'Your cryptocurrency deposit with transaction number ' . $data->trx . '  was successful. Your account has been credited as required, Thank you for choosing ' . $basic->sitename . '',
                'admin' => 1,
                'status' => 0
            ]);

            return redirect()->route('my-wallet')->with(['modal' => 'power', "success" => 'Your BTC Deposit with transaction number ' . $data->trx . '  was successful.']);
        }

    }


    public function wallet()
    {
        $data['page_title'] = "Crypto Wallets";
        $data['wallet'] = Cryptowallet::where('user_id', Auth::id())->orderBy('name', 'asc')->get();
        return view('user.wallet', $data);
    }


    public function updatewallet(Request $request)
    {
        $wallet = Cryptowallet::findOrFail($request->wallet);
        $wallet->address = $request->address;
        $wallet->save();

        return back()->with('success', 'Wallet Address Updated Successfully.');


        return view('user.wallet', $data);
    }


    public function convertbonus()
    {
        $data['page_title'] = "Convert Bonus";
        return view('user.convert', $data);
    }


    public function updateconvert(Request $request)
    {
        $basic = GeneralSettings::first();
        $this->validate($request, [
            'amount' => 'required|numeric|min:' . $basic->minbonus . '',
        ], [
            'amount.required' => 'The minimum amount you can convert is ' . $basic->currency . '' . $basic->minbonus . ' '
        ]);
        $user = Auth::user();

        if ($request->amount > $user->bonus) {
            return back()->with('alert', 'You Cant Convert An Amount Greater Than Your Current Bonus Balance.');
        }


        $user->balance = $user->balance + $request->amount;
        $user->bonus = $user->bonus - $request->amount;
        $user->save();
        return back()->with('success', 'Bonus Converted Successfuly.');

    }

    public function transfer()
    {
        $data['page_title'] = "Transfer Fund";
        $user = Auth::user();
        $data['wallet'] = UserWallet::whereUser_id($user->id)->first();
        $data['transfer'] = Transfer::where('user_id', Auth::id())->get();
        $data['transfers'] = Transfer::where('user_id', Auth::id())->sum('amount');
        return view('user.transfer', $data);
    }


    public function updatetransfer(Request $request)
    {
        $basic = GeneralSettings::first();
        if ($request->wallet == 0) {
            $user = Auth::user();
            $amount = $request->amount;
        } else {
            $user = UserWallet::whereUser_id($user->id)->first();
            $amount = $request->amount * $basic->rate;
        }
        $basic = GeneralSettings::first();
        if ($request->amount > $user->balance) {
            return back()->with('danger', 'You Cant Transfer An Amount Greater Than Your Current Balance.');
        }

        $count = User::whereUsername($request->username)->count();
        if ($count < 1) {
            return back()->with('danger', 'There is no username with such username on ' . $basic->sitename . ' Please re-check and try again.');
        }

        if ($count > 0) {
            $receiver = User::whereUsername($request->username)->first();


            $receiver->balance = $receiver->balance + $amount;
            $receiver->save();
        }

        $tr = strtoupper(str_random(20));
        $w['amount'] = $amount;
        $w['transaction_id'] = $tr;
        $w['user_id'] = Auth::user()->id;
        $w['send_details'] = $request->username;
        $w['status'] = 2;
        $trr = Transfer::create($w);


        Trx::create([
            'user_id' => Auth::user()->id,
            'amount' => round($amount, $basic->decimal),
            'charge' => 0,
            'type' => '-',
            'action' => "Transfer",
            'title' => 'Transfer fund to ' . $request->username,
            'trx' => $tr
        ]);


        $user->balance = $user->balance - $amount;
        $user->save();
        return back()->with('success', 'Fund transfered to ' . $request->username . ' successfully.');

    }

    public function transferlog()
    {
        $data['transfer'] = Transfer::where('user_id', Auth::id())->get();
        return view('user.transfer-log', $data);
    }


    public function withdrawMoney()
    {
        $data['withdrawMethod'] = WithdrawMethod::where('id', '>', 1)->orderBy('name', 'asc')->get();
        $data['withdrawMethod1'] = WithdrawMethod::whereId(1)->orderBy('name', 'asc')->get();
        $data['page_title'] = "Withdraw Money";
        $data['wallet'] = Cryptowallet::where('user_id', Auth::id())->orderBy('name', 'asc')->get();
        return view('user.withdraw-money', $data);
    }

    public function requestcrypto(Request $request)
    {
        $this->validate($request, [
            'method_id' => 'required|numeric',
            'amount' => 'required|numeric',
            'wallet' => 'required'
        ]);
        $basic = GeneralSettings::first();
        $wallet = Cryptowallet::findOrFail($request->wallet);


        $method = WithdrawMethod::findOrFail($request->method_id);
        $currency = Currency::findOrFail($wallet->coin_id);
        $ch = $method->fix + round(($request->amount * $method->percent) / 100, $basic->decimal);
        $reAmo = $request->amount + $ch;
        if ($wallet->address == 0) {
            return back()->with('alert', 'You need to update your ' . $wallet->name . ' wallet details before you can withdraw from your ' . $wallet->name . ' wallet.');
        }
        if ($reAmo < $method->withdraw_min) {
            return back()->with('alert', 'The Requested Amount is Smaller Than Withdraw Minimum Amount.');
        }
        if ($reAmo > $method->withdraw_max) {
            return back()->with('alert', 'The Requested Amount is Larger Than Withdraw Maximum Amount.');
        }
        if ($reAmo > $wallet->balance) {
            return back()->with('alert', 'The Request Amount is More Than Your ' . $wallet->name . ' Wallet Current Balance.');
        }

        $tr = strtoupper(str_random(20));
        $w['amount'] = $request->amount;
        $w['method_id'] = $request->method_id;
        $w['charge'] = $ch;
        $w['transaction_id'] = $tr;
        $w['net_amount'] = $reAmo;
        $w['user_id'] = Auth::user()->id;
        $w['currency_id'] = $currency->id;
        $w['wallet_id'] = $request->wallet;
        $trr = WithdrawLog::create($w);
        $data['withdraw'] = $trr;
        Session::put('wtrx', $trr->transaction_id);

        $data['method'] = $method;
        $data['amount'] = $request->amount;
        $data['charge'] = $ch;
        $data['wallet'] = Cryptowallet::findOrFail($request->wallet);;

        $data['page_title'] = "Withdraw Preview";
        return view('user.withdraw-crypto', $data);

    }


    public function requestwithdrawal(Request $request)
    {
        $this->validate($request, [
            'method_id' => 'required|numeric',
            'amount' => 'required|numeric|min:1',
        ]);
        $user = Auth::user();

        if ($user->withdrawpass != $request->pin) {
            return back()->with('alert', 'You have entered a wrong withdraw pin. Please try again.');
        }
        $basic = GeneralSettings::first();

        if ($request->wallet == "1") {
            $wallet = Auth::user();
        } else {
            $wallet = UserWallet::where('user_id', Auth::id())->where('type', 'interest_wallet')->first();
        }


        $user = Auth::user();
        $method = WithdrawMethod::findOrFail($request->method_id);
        $ch = $method->fix + round(($request->amount * $method->percent) / 100, $basic->decimal);
        $reAmo = $request->amount + $ch;

        if ($request->method_id == 1) {

            $this->validate($request, [
                'walletaddress' => 'required',
            ]);
            $pay = $request->walletaddress;
        }
        if ($request->method_id == 2) {

            $this->validate($request, [
                'paypaladdress' => 'required',
            ]);
            $pay = $request->paypaladdress;
        }
        if ($request->method_id == 3) {


            session()->flash('success', 'Please proceed with your transfer by filling the form below. ');

            return redirect()->route('banktransfer');

            $this->validate($request, [
                'bankname' => 'required',
                'accountname' => 'required',
                'accountnumber' => 'required',
            ]);
            $pay = "Bank Name: " . $request->paypaladdress . ", Account Name:" . $request->accountname . ", Account Number:" . $request->accountnumber;
        }

        if ($request->method_id == 4) {

            $this->validate($request, [
                'cashname' => 'required',
                'accountnumber' => 'required',
                'accountname' => 'required',
            ]);
            $pay = "Cash App Name: " . $request->cashname . ", Account Name: " . $request->accountname . ", Account Number: " . $request->accountnumber;
        }
        if ($reAmo < $method->withdraw_min) {
            return back()->with('alert', 'The Requested Amount is Smaller Than Withdraw Minimum Amount.');
        }
        if ($reAmo > $method->withdraw_max) {
            return back()->with('alert', 'The Requested Amount is Larger Than Withdraw Maximum Amount.');
        }
        if ($reAmo > $wallet->balance) {
            return back()->with('alert', 'The Request Amount is More Than Your Wallet Current Balance.');
        }

        $tr = strtoupper(str_random(20));
        $w['amount'] = $request->amount;
        $w['method_id'] = $request->method_id;
        $w['charge'] = $ch;
        $w['transaction_id'] = $tr;
        $w['net_amount'] = $reAmo;
        $w['user_id'] = Auth::user()->id;
        $trr = WithdrawLog::create($w);
        $data['withdraw'] = $trr;
        Session::put('wtrx', $trr->transaction_id);

        $data['method'] = $method;
        $data['amount'] = $request->amount;
        $data['charge'] = $ch;
        $data['pay'] = $pay;

        $data['page_title'] = "Withdraw Preview";
        return view('user.withdraw-fiat', $data);

    }


    public function requestSubmit(Request $request)
    {
        $basic = GeneralSettings::first();
        $this->validate($request, [
            'withdraw_id' => 'required|numeric',
            'send_details' => 'required'
        ]);

        $ww = WithdrawLog::findOrFail($request->withdraw_id);
        $ww->send_details = $request->send_details;
        $ww->message = $request->message;
        $ww->status = 0;
        $ww->save();

        $user = Auth::user();
        $user->balance = $user->balance - $ww->net_amount;
        $user->save();


        $text = $ww->amount . " - " . $basic->currency . " Withdraw Request Send via " . $ww->method->name . ". <br> Transaction ID Is : <b>#$ww->transaction_id</b>";
        notify($user, 'Withdraw Via ' . $ww->method->name, $text);
        return redirect()->route('user.withdrawLog')->with('success', 'Withdraw request has been successfully submitted. Please Wait For Confirmation.');
    }


    public function cancelmywithdraw($id)
    {
        $ww = WithdrawLog::whereId($id)->whereStatus(0)->first();
        $count = WithdrawLog::whereId($id)->whereStatus(0)->count();

        if ($count < 1) {
            return back()->with('error', 'There is no withdrawal log with this details');

        }
        $ww->delete();
        $user = Auth::user();
        $user->balance = $user->balance + $ww->net_amount;
        $user->save();
        return back()->with('success', 'Withdrawal has been canceled and fund returned to Naira wallet');
    }


    public function activity()
    {
        $user = Auth::user();
        $data['invests'] = Trx::whereUser_id($user->id)->latest()->paginate(15);
        $data['page_title'] = "Transaction Log";
        return view('user.trx', $data);
    }

    public function mywallet()
    {
        $user = Auth::user();
        $baseUrl = "https://blockchain.info/";
        $endpoint = "tobtc?currency=USD&value=1";
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

        $data['btcrate'] = json_decode(curl_exec($ch), true);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        curl_close($ch);
        $data['pdep'] = Deposit::whereUser_id($user->id)->whereStatus(0)->sum('amount');
        $data['tdep'] = Deposit::whereUser_id($user->id)->whereStatus(1)->sum('amount');
        $data['pdepositlog'] = Deposit::whereUser_id($user->id)->whereStatus(2)->get();
        $data['pwithdrawlog'] = WithdrawLog::whereUser_id($user->id)->whereStatus(1)->get();
        $data['pwith'] = WithdrawLog::whereUser_id($user->id)->whereStatus(1)->sum('amount');
        $data['twith'] = WithdrawLog::whereUser_id($user->id)->whereStatus(2)->sum('amount');
        $data['activeinv'] = Invest::whereUser_id($user->id)->whereStatus(1)->count();
        $data['endinv'] = Invest::whereUser_id($user->id)->whereStatus(0)->count();
        $data['withdrawgate'] = WithdrawMethod::whereStatus(1)->get();
        $data['investment'] = UserWallet::where('user_id', Auth::id())->where('type', 'interest_wallet')->first();
        $data['page_title'] = "My Wallet";
        $data['gates'] = Gateway::whereStatus(1)->orderBy('name', 'asc')->get();
        return view('user.my-wallet', $data);
    }

    public function depositLog()
    {
        $user = Auth::user();

        $data['page_title'] = "Deposit Log";
        $data['deposit'] = Deposit::whereUser_id($user->id)->latest()->paginate(10);
        $data['count'] = Deposit::whereUser_id($user->id)->count();
        $data['sum'] = Deposit::whereStatus(1)->whereUser_id($user->id)->sum('amount');
        return view('user.deposit-log', $data);
    }

    public function withdrawLog()
    {
        $user = Auth::user();
        $data['withdraw'] = WithdrawLog::whereUser_id($user->id)->latest()->get();
        $data['count'] = WithdrawLog::whereUser_id($user->id)->count();
        $data['sum'] = WithdrawLog::whereStatus(2)->whereUser_id($user->id)->sum('amount');
        $data['wpend'] = WithdrawLog::whereStatus(1)->whereUser_id($user->id)->sum('amount');
        $data['page_title'] = "Withdraw Log";
        return view('user.withdraw-log', $data);
    }


    public function tradecoin()
    {
        $auth = Auth::user();
        if ($auth->verified != 2) {
            return back()->withAlert('You are not eligible to trade cryptocurrency. Please verify your account first');
        }


        $get['pendbuy'] = Trx::where('status', 1)->where('type', 1)->sum('amount');
        $get['totalbuy'] = Trx::where('status', 2)->where('type', 1)->sum('amount');
        $get['pendsell'] = Trx::where('status', 1)->where('type', 2)->sum('amount');
        $get['totalsell'] = Trx::where('status', 2)->where('type', 2)->sum('amount');
        $get['currency'] = Currency::whereStatus(1)->orderBy('name', 'asc')->get();
        $get['method'] = PaymentMethod::whereStatus(1)->orderBy('name', 'asc')->get();
        $get['bank'] = Bank::whereStatus(1)->orderBy('name', 'asc')->get();
        $get['page_title'] = "Trade E-Currency";

        $get['trade'] = Trx::where('status', '>', 0)->latest()->paginate(5);
        return view('user.trade', $get);
    }

    public function buycoin()
    {
        $auth = Auth::user();
        if ($auth->verified != 2) {
            return back()->withAlert('You are not eligible to buy cryptocurrency. Please verify your account first');
        }

        $get['currency'] = Currency::whereStatus(1)->orderBy('name', 'asc')->get();
        $get['method'] = PaymentMethod::whereStatus(1)->orderBy('name', 'asc')->get();
        $get['bank'] = Bank::whereStatus(1)->orderBy('name', 'asc')->get();
        $get['page_title'] = " Buy E-Currency";
        return view('user.buy', $get);
    }

    public function sellcoin()
    {


        $get['page_title'] = "Sell Currency";
        $get['currency'] = Currency::whereStatus(1)->orderBy('name', 'asc')->get();
        $get['method'] = PaymentMethod::whereStatus(1)->orderBy('name', 'asc')->get();
        $get['bank'] = Bank::whereStatus(1)->orderBy('name', 'asc')->get();
        return view('user.sell', $get);
    }


    public function buyecoin(Request $request)
    {
        $this->validate($request, [
            'wallet' => 'required',
            'rewallet' => 'required',
            'usd' => 'required',
            'coin' => 'required',
            'payment' => 'required',
        ]);


        $auth = Auth::user();
        $basic = GeneralSettings::first();
        $currency = Currency::whereId($request->coin)->first();
        $trx = rand(000000, 999999) . rand(000000, 999999);


        if ($request->wallet != $request->rewallet) {
            return back()->with("alert", "Your confirm wallet address entry does not tally with the wallet address ");
        }

        if ($request->payment == 2) {


            $charge = $basic->transcharge;
            $usd = $request->usd * $currency->buy;
            $topay = $usd + $charge;
            $get = $request->usd / $currency->price;

            $buy['currency_id'] = $currency->id;
            $buy['amount'] = $request->usd;
            $buy['main_amo'] = $topay;
            $buy['charge'] = $charge;
            $buy['price'] = $currency->price;
            $buy['getamo'] = $get;
            $buy['user_id'] = Auth::id();
            $buy['type'] = 1;
            $buy['method'] = $request->method;
            $buy['wallet'] = $request->wallet;
            $buy['rate'] = $currency->buy;
            $buy['bank'] = $request->bank;
            $buy['remark'] = $request->comment;
            $buy['status'] = 0;
            $buy['trx'] = $trx;
            $data = Trx::create($buy)->trx;

            Session::put('Track', $buy['trx']);
            return redirect()->route('user.ebuy');
        } elseif ($request->payment == 1) {

            if ($request->gateway == 107) {
                $gate = Gateway::whereId(107)->first();
            }


            if ($request->gateway == 103) {
                $gate = Gateway::whereId(103)->first();
            }


            if ($request->gateway == 100) {

                $gate = Gateway::whereId(100)->first();
            }

            if ($request->gateway == 99) {
                $gate = Gateway::whereId(99)->first();

                if ($request->local < $auth->balance) {
                    return back()->with("alert", "You dont have enough fund in your Naira wallet.Please deposit more fund or try using another payment gateway");
                }


            }

            $charge = $basic->transcharge;
            $usd = $request->usd * $currency->buy;
            $topay = $usd + $charge;
            $get = $request->usd / $currency->price;

            $buy['currency_id'] = $currency->id;
            $buy['amount'] = $request->usd;
            $buy['main_amo'] = $topay;
            $buy['charge'] = $charge;
            $buy['price'] = $currency->price;
            $buy['getamo'] = $get;
            $buy['user_id'] = Auth::id();
            $buy['type'] = 1;
            $buy['method'] = $request->method;
            $buy['wallet'] = $request->wallet;
            $buy['rate'] = $currency->sell;
            $buy['bank'] = $request->bank;
            $buy['gateway'] = 1;
            $buy['remark'] = $request->comment;
            $buy['status'] = 0;
            $buy['trx'] = $trx;
            $data = Trx::create($buy)->trx;

            Session::put('Track', $buy['trx']);
            return redirect()->route('user.ebuy');

        }


    }

    public function ebuyonlinePreview()
    {

        $track = Session::get('Track');
        $data = Trx::where('status', 0)->where('trx', $track)->first();
        $page_title = "Purchase Preview";
        $auth = Auth::user();

        $user=User::find(Auth::id());

        $time = Carbon::parse(Carbon::now())->addMinutes(30);
        $user->login_time = $time;
        $user->save();


        $basic = GeneralSettings::first();
        date_default_timezone_set($auth->timezone);
        $d = strtotime("+$basic->trxcancel minutes");
        $timeout = date("Y-m-d h:i:sa", $d);


        $start = $data->created_at;
        $time = date('Y-m-d H:i:s', strtotime('+1 hour', strtotime($start)));


        $start2 = $time;
        $timeout = date('Y-m-d H:i:s', strtotime('+30 minutes', strtotime($start2)));

        $data['timeout'] = $timeout;
        $data->save();


        return view('user.ebuy', compact('data', 'page_title'));
    }

    public function ebuyonlinepay($id)
    {
        $data = Trx::where('status', 0)->where('trx', $id)->first();
        $page_title = "Purchase Preview";
        $auth = Auth::user();
        return view('user.ebuypay', compact('data', 'page_title'));
    }

    public function ebuydel($id)
    {
        $data = Trx::where('status', 0)->where('trx', $id)->first();
        $page_title = "Purchase Preview";
        $auth = Auth::user();
        $data->delete();
        return redirect()->route('home')->with("success", "Unpaid Transaction Was Deleted successful");
    }


    public function ebuyonlinepost($id)
    {
        $data = Trx::where('status', 0)->where('trx', $id)->first();
        Session::put('Track', $data->trx);
        return redirect()->route('ebuypost2');
    }


    public function ebuyonlinepost2()
    {
        $track = Session::get('Track');
        $data = Trx::where('status', 0)->where('trx', $track)->first();
        $method = PaymentMethod::all();
        $page_title = "Purchase Coin";
        $auth = Auth::user();
        return view('user.ebuypay', compact('data', 'method', 'page_title'));

    }


    public function ebuyonlinepost22($id)
    {
        $data = Trx::where('status', 0)->where('trx', $id)->first();
        $method = PaymentMethod::all();
        $page_title = "Purchase Coin";
        $auth = Auth::user();
        return view('user.ebuypay', compact('data', 'method', 'page_title'));

    }

    public function ebuypeerpay($id)
    {
        
        $data = Trx::where('status', 1)->where('trx', $id)->first();
        
        if(!$data){
             return back()->with('danger', 'This transaction has expired or does not exist');
        }
        
        if($data->action != 1){
             return back()->with('danger', 'You have not been paired to execute this transaction');
        }
        $method = PaymentMethod::all();
        $page_title = "Make Payment";
        $auth = Auth::user();
        return view('user.buypeer', compact('data', 'method', 'page_title'));

    }
    
    
    public function ebuypeerpaid(Request $request)
    {

         $this->validate($request, [
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        
        $basic = GeneralSettings::first();
        $data = Trx::where('action', 1)->where('trx', $request->trx)->first();
        $count = Trx::where('action', 1)->where('trx', $request->trx)->count();
        $auth = Auth::user();

        if ($count < 1) {
            return back()->with('danger', 'This transaction has expired or does not exist');
        }

        $data->action = 2;
        if ($request->hasFile('photo')) {
            $data['image'] = uniqid() . '.jpg';
            $request->photo->move('uploads/payments', $data['image']);
        }


        $data->save();

        Message::create([
            'user_id' => $auth->id,
            'title' => 'Coin Purchased',
            'details' => 'You have uploaded your proof of payment successfully for your buy order  with transaction number ' . $data->trx . 'Please wait while seller verifies your payment. Thank you for choosing ' . $basic->sitename . '',
            'admin' => 1,
            'status' => 0
        ]);
 

        return redirect()->route('trade')->with("success", " You have uploaded your proof of payment successfully. Please wait while seller verifies your payment");

    }


    public function ebuyupload(Request $request)
    {


        $basic = GeneralSettings::first();
        $data = Trx::where('status', 0)->where('trx', $request->trx)->first();
        $count = Trx::where('status', 0)->where('trx', $request->trx)->count();
        $auth = Auth::user();

        if ($count < 1) {
            return back()->with('danger', 'This transaction has expired or does not exist');
        }

        $data->amountpaid = $data->main_amo;
        $data->depositor = $auth->username;
        //$data->tnum = rand(000000, 999999) . rand(000000, 999999);
        $data->method = 1;
        $data->status = 1;
        if ($request->hasFile('photo')) {
            $data['image'] = uniqid() . '.jpg';
            $request->photo->move('uploads/payments', $data['image']);
        }


        $data->save();

        Message::create([
            'user_id' => $auth->id,
            'title' => 'Coin Purchased',
            'details' => 'Your ' . $basic->currency_sym . '' . $request->amount . ' with transaction number ' . $data->trx . 'cryptocurrency purchase was successful. Please wait while our server verifies your purchase. Your account will be credited once payment is confirmed by our server, Thank you for choosing ' . $basic->sitename . '',
            'admin' => 1,
            'status' => 0
        ]);

        $dat['user_id'] = Auth::id();
        $dat['title'] = "Buy Crypto";
        $dat['details'] = "I request to buy crypto with transaction id ".$request->trx;
        $dat['status'] = 0;
        Message::create($dat);

        return redirect()->route('trade')->with("success", "  Your coin purchase was successful. Please wait while we process your request");

    }

    public function trxdel($id)
    {
        $data = Trx::where('status', 0)->where('id', $id)->first();
        $page_title = "Purchase Preview";
        $data->delete();
        return redirect()->route('home')->with("success", "Unpaid Transaction Was Deleted successful");
    }


    public function sellecoin(Request $request)
    {
        $this->validate($request, [
            'coin' => 'required',
            'usd' => 'required',
        ]);


        $auth = Auth::user();
        $basic = GeneralSettings::first();
        $currency = Currency::whereId($request->coin)->first();
        $trx = rand(000000, 999999) . rand(000000, 999999);


        $charge = $basic->transcharge;
        $usd = $request->usd * $currency->buy;
        $topay = $usd + $charge;


        $buy['currency_id'] = $currency->id;
        $buy['amount'] = $request->usd;
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
        $data = Trx::create($buy)->trx;

        Session::put('Track', $buy['trx']);
        return redirect()->route('user.esell');

    }

    public function esellonlinePreview()
    {

        $track = Session::get('Track');
        $data = Trx::where('status', 0)->where('trx', $track)->first();
        $page_title = "Purchase Preview";
        $auth = Auth::user();

        $basic = GeneralSettings::first();
        date_default_timezone_set($auth->timezone);
        $d = strtotime("+$basic->trxcancel minutes");
        $timeout = date("Y-m-d h:i:sa", $d);


        $start = $data->created_at;
        $time = date('Y-m-d H:i:s', strtotime('+1 hour', strtotime($start)));


        $start2 = $time;
        $timeout = date('Y-m-d H:i:s', strtotime('+30 minutes', strtotime($start2)));

        $data['timeout'] = $timeout;
        $data->save();


        return view('user.esell', compact('data', 'page_title'));
    }

    public function esellonlinepay()
    {
        $track = Session::get('Track');
        $data = Trx::where('status', 0)->where('trx', $track)->first();
        $page_title = "Sales Preview";
        $auth = Auth::user();
        return view('user.esellpay', compact('data', 'page_title'));
    }

    public function esellscan()
    {

        $track = Session::get('Track');
        $data = Trx::where('status', 0)->where('trx', $track)->first();
        $currency = Currency::where('id', $data->currency_id)->first();
        $page_title = "Sales Preview";
        $auth = Auth::user();

        $getamount = Session::get('putamount');
        $gettime = Session::get('timestamp');
        $gettrx = Session::get('puttrx');
        $getaddress = Session::get('putaddress');

        $basic = GeneralSettings::first();

        if (Carbon::parse($gettime)->addMinutes(15) > Carbon::now() && $gettime != '') {

            $address = $getaddress;
            $btcvalue = $getamount;

            return view('user.esellscan', compact('data', 'btcvalue', 'address', 'page_title'));

        } else {

            if($currency->symbol=="BTC"){
                $akey=$basic->bitcoin_address;
            }else{
                $akey=$basic->etherum_address;
            }

            $baseurl = "https://coinremitter.com/api/v3/" . $currency->symbol . "/create-invoice";
//		$baseurl = "https://coinremitter.com/api/v3/TCN/create-invoice";
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
                CURLOPT_POSTFIELDS => array('api_key' => $akey, 'password' => 'visionxcrypto', 'amount' => $data->amount, 'name' => $data->trx, 'currency' => 'USD', 'expire_time' => '15', 'suceess_url' => url("/api/sellcallback")),
            ));

            $response = curl_exec($curl);
            $reply = json_decode($response, true);
            curl_close($curl);

            if(!isset($reply['data']['address'])){
                return back()->with('error','Amount too low');
            }

            $address = $reply['data']['address'];
            $invoiceid = $reply['data']['invoice_id'];
//		$btcvalue = $reply['data']['total_amount']['TCN'];
            if($currency->symbol=="BTC") {
                $btcvalue = $reply['data']['total_amount']['BTC'];
            }else{
                $btcvalue = $reply['data']['total_amount']['ETH'];
            }

            $data->action = $invoiceid;
            $data->method = $currency->symbol;
            $data->save();

            Session::put('puttrx', $data->trx);
            Session::put('amount', $data->amount);
            Session::put('timestamp', Carbon::now());
            Session::put('putamount', $btcvalue);
            Session::put('putaddress', $address);

        }

        return view('user.esellscan', compact('data', 'btcvalue', 'address', 'page_title'));
    }


    public function esellpm($trx)
    {
        $data = Trx::where('status', 0)->where('trx', $trx)->first();
        $auth = Auth::user();
        Session::put('Perfect', $trx);

        $gatewayData = Gateway::find(102);
        return view('user.esellpm', compact('data', 'gatewayData'));
    }

    public function sellperfectsuccess()
    {
        $gatewayData = Gateway::find(102);

        $passphrase = strtoupper(md5($gatewayData->val2));
         $track = Session::get('Perfect');
        define('ALTERNATE_PHRASE_HASH', $passphrase);
        define('PATH_TO_LOG', '/somewhere/out/of/document_root/');

            $data = Trx::where('status', 0)->where('trx', $track)->first();
            $user = User::whereId($data->user_id)->first();
            $gnl = GeneralSettings::first();

               $data->status = 2;
               $data->save();

               $user->balance = $user->balance + $data->main_amo;
               $user->save();
                return redirect()->route('home')->with("success", "Perfect Money Sales Was Successful");


    }


    public function esellscan2($id)
    {
        $data = Trx::where('status', 0)->where('trx', $id)->first();
        $page_title = "Sales Preview";
        $auth = Auth::user();
        return view('user.esellscan', compact('data', 'page_title'));
    }

    public function eselldel($id)
    {
        $data = Trx::where('status', 0)->where('trx', $id)->first();
        $page_title = "Sale Preview";
        $auth = Auth::user();
        $data->delete();
        return redirect()->route('banktransfer')->with("success", "Unpaid Transaction Was Deleted successful");
    }


    public function esellonlinepost($id)
    {
        $data = Trx::where('status', 0)->where('trx', $id)->first();
        Session::put('Track', $data->trx);
        return redirect()->route('esellpost2');
    }


    public function esellupload(Request $request)
    {
        $this->validate($request,
            [
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'trxx' => 'required',
            ]);

        $basic = GeneralSettings::first();
        $data = Trx::where('status', 0)->where('trx', $request->trx)->first();
        $page_title = "Sold Coin";
        $auth = Auth::user();

        $data->tnum = $request->trxx;
        $data->status = 1;
        if ($request->hasFile('photo')) {
            $data['image'] = uniqid() . '.jpg';
            $request->photo->move('uploads/payments', $data['image']);
        }
        $data->save();


        Message::create([
            'user_id' => $auth->id,
            'title' => 'Coin Sold',
            'details' => 'Your USD' . $data->amount . ' sale with transaction number ' . $data->trx . ' was successful. Please wait while our server verifies your sale. Your account will be credited once payment is confirmed by our server, Thank you for choosing ' . $basic->sitename . '',
            'admin' => 1,
            'status' => 0
        ]);


        return redirect()->route('trade')->with("success", "  Your coin sale was successful. Please wait while we process your transaction");

    }


    public function esellcallback(Request $request)
    {

        $basic = GeneralSettings::first();
        $data = Trx::where('status', 0)->where('trx', $request->trx)->first();
        $auth = Auth::user();
        $data->save();

        if($data->method=="BTC"){
            $akey=$basic->bitcoin_address;
        }else{
            $akey=$basic->etherum_address;
        }

        $baseurl = "https://coinremitter.com/api/v3/" . $data->method . "/get-invoice";
//        $baseurl = "https://coinremitter.com/api/v3/TCN/get-invoice";
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
            CURLOPT_POSTFIELDS => array('api_key' => $akey, 'password' => 'visionxcrypto', 'invoice_id' => $data->action),
        ));

        $response = curl_exec($curl);
        $reply = json_decode($response, true);
        curl_close($curl);

        if (!isset($reply['data']['status_code'])) {
            return back()->with("danger", "An error occur. Contact server admin");
        }

        $status = $reply['data']['status_code'];

        if ($status == 0) {
            return back()->with("danger", "We have not received your payment. Kindly Scan and make payment");
        }

        if ($data->status == 2) {
            return redirect()->route('products')->with("danger", "Payment has been made already");
        }


        if ($status == 1 || $status == 3) {
            $basic = GeneralSettings::first();
            $data->status = 2;
            $data->save();

            $product['user_id'] = $data->user_id;
            $product['gateway'] = $data->currency_id;
            $product['account_number'] = $data->trx;
            $product['type'] = 1;
            $product['remark'] = "C";
            $product['trx'] = $data->trx;
            $product['status'] = 1;
            $product['amount'] = $data->main_amo;
            Transaction::create($product);

            $user = User::find($data->user_id);
            $user->balance += $data->main_amo;
            $user->save();

            Message::create([
                'user_id' => $data->user_id,
                'title' => 'Coin Purchase Successful',
                'details' => 'Your cryptocurrency purchase with transaction number ' . $data->trx . '  was successful. Your account has been credited as required, Thank you for choosing ' . $basic->sitename . '',
                'admin' => 1,
                'status' => 0
            ]);

            return redirect()->route('products')->with(['modal' => 'power', "success" => 'Your cryptocurrency purchase with transaction number ' . $data->trx . '  was successful.']);
        }

    }


    public function buyonline(Request $request)
    {
        $auth = Auth::user();
        $basic = GeneralSettings::first();
        $currency = Currency::whereId($request->coin)->first();
        $wallet = Cryptowallet::whereUser_id($auth->id)->whereCoin_id($request->coin)->first();
        $trx = rand(000000, 999999) . rand(000000, 999999);

        $lenght = strlen($request->address);


        if ($request->radio == "paystack") {
            $gate = Gateway::whereId(107)->first();
        }


        if ($request->radio == "stripe") {
            $gate = Gateway::whereId(103)->first();
        }


        if ($request->radio == "rave") {
            $gate = Gateway::whereId(100)->first();
        }


        if ($wallet->address == "0") {
            return back()->with("alert", "Please setup your $wallet->name wallet addres first before you make withdrawal");
        }


        if ($lenght < 10) {
            return back()->with("alert", "You have setup a wrong $wallet->name wallet address. Please update your walletaddress");
        }


        $buy['currency_id'] = $currency->id;
        $buy['enter_amount'] = round($request->amount, $basic->decimal);
        $buy['get_amount'] = $request->unit;
        $buy['buy_charge'] = round($request->charge, $basic->decimal);
        $buy['buy_price'] = $currency->price;
        $buy['user_id'] = Auth::id();
        $buy['type'] = 1;
        $buy['status'] = 0;
        if ($request->radio == "bank") {
            $buy['gateway'] = 999;
        } else {
            $buy['gateway'] = $gate->id;
        }
        if ($request->radio == "bank") {
            $buy['info'] = "Bought " . $wallet->name . " using Bank Transfer";
        } else {
            $buy['info'] = "Bought " . $wallet->name . " using Credit Card";
        }
        $buy['account'] = $request->address;
        $buy['trx'] = $trx;
        $data = BuyMoney::create($buy)->trx;

        Session::put('Track', $buy['trx']);
        return redirect()->route('user.onlinebuy');

    }

    public function buyonlinePreview()
    {

        $track = Session::get('Track');
        $data = Buymoney::where('status', 0)->where('trx', $track)->first();
        $page_title = "Purchase Preview";
        $auth = Auth::user();
        return view('user.onlinebuy', compact('data', 'page_title'));
    }

    public function sellwallet(Request $request)
    {
        $this->validate($request, [
            'radio2' => 'required',
        ], [
            'radio2.required' => 'Please select a method to payment '
        ]);
        $auth = Auth::user();
        $basic = GeneralSettings::first();
        $currency = Currency::whereId($request->coin)->first();
        $wallet = Cryptowallet::whereUser_id($auth->id)->whereCoin_id($request->coin)->first();
        $trx = rand(000000, 999999) . rand(000000, 999999);

        $lenght = strlen($request->radio2);
        if ($wallet->balance < $request->unit) {
            return back()->with("alert", "You dont have enough balance in your " . $wallet->name . " wallet");
        }

        if ($wallet->address == "0") {
            return back()->with("alert", "Please setup your payment account first before your make sales");
        }


        if ($lenght < 5) {
            return back()->with("alert", "You have setup a wrong payment account. Please update your payment account");
        }

        $wallet->balance = $wallet->balance - 3;
        $wallet->save();

        $buy['currency_id'] = $currency->id;
        $buy['enter_amount'] = round($request->amount, $basic->decimal);
        $buy['get_amount'] = $request->unit;
        $buy['sell_charge'] = round($request->charge, $basic->decimal);
        $buy['sell_price'] = $currency->price;
        $buy['user_id'] = Auth::id();
        $buy['type'] = 0;
        $buy['status'] = 1;
        if ($request->radio2 == "Deposit Wallet") {
            $buy['payout'] = 1;
        }
        $buy['email'] = $request->radio2;
        $buy['trx'] = $trx;
        $data = SellMoney::create($buy)->trx;

        Trx::create([
            'user_id' => $auth->id,
            'amount' => $request->amount,
            'main_amo' => round($auth->balance, $basic->decimal),
            'charge' => $request->charge,
            'type' => '-',
            'action' => 'Sales',
            'title' => ' Sold ' . $request->unit . ' ' . $currency->symbol,
            'trx' => $trx
        ]);

        Message::create([
            'user_id' => $auth->id,
            'title' => 'Coin Sold',
            'details' => 'Your ' . $request->unit . '' . $currency->symbol . ' cryptocurrency sales valued at ' . $basic->currency . '' . round($request->amount - $request->charge, $basic->decimal) . ' was successful. ' . $request->unit . '' . $currency->symbol . ' was debited from your ' . $basic->sitename . '  ' . $currency->name . ' wallet. Please wait while our server verifies your sale. Your account will be credited once coin is confirmed by our server, Thank you for choosing ' . $basic->sitename . '',
            'admin' => 1,
            'status' => 0
        ]);


        $txt = $request->amount . ' ' . $currency->symbol . ' Sold Amount  ';
        send_email($auth->email, $auth->username, 'Sold Amount', $txt);
        return redirect()->route('home')->with("success", "  Your coin sales was successful");

    }

    public function sellonline(Request $request)
    {
        $this->validate($request, [
            'radio' => 'required',
        ], [
            'radio.required' => 'Please select a method to payment '
        ]);
        $auth = Auth::user();
        $currency = Currency::whereId($request->coin)->first();
        $basic = GeneralSettings::first();
        $trx = rand(000000, 999999) . rand(000000, 999999);
        $sell['currency_id'] = $currency->id;
        $sell['enter_amount'] = round($request->amount, $basic->decimal);
        $sell['get_amount'] = $request->unit;
        $sell['sell_charge'] = round($request->charge, $basic->decimal);
        $sell['sell_price'] = $currency->price;
        $sell['user_id'] = Auth::id();
        $sell['type'] = 1;
        $sell['status'] = 0;
        if ($request->radio2 == "Deposit Wallet") {
            $buy['payout'] = 1;
        }

        $sell['account'] = $request->account;
        $sell['email'] = $request->radio;
        $sell['trx'] = $trx;
        $sell = SellMoney::create($sell)->trx;

        Trx::create([
            'user_id' => $auth->id,
            'amount' => $request->amount,
            'main_amo' => round($auth->balance, $basic->decimal),
            'charge' => $request->charge,
            'type' => '-',
            'action' => 'Sales',
            'title' => ' Sold ' . $request->unit . ' ' . $currency->symbol,
            'trx' => $trx
        ]);


        $auth = Auth::user();
        $sell = SellMoney::where('trx', $trx)->where('user_id', $auth->id)->whereStatus(0)->first();
        $basic = GeneralSettings::first();
        Message::create([
            'user_id' => $auth->id,
            'title' => 'Coin Sold',
            'details' => 'Your ' . $request->unit . '' . $currency->symbol . ' cryptocurrency sales valued at ' . $basic->currency . '' . round($request->amount - $request->charge, $basic->decimal) . ' was successful. Please wait while our server verifies your sale. Your account will be credited once coin is confirmed by our server, Thank you for choosing ' . $basic->sitename . '',
            'admin' => 1,
            'status' => 0
        ]);


        if ($sell) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = $sell->trx . '.jpg';
                $location = 'sales/' . $filename;
                $sell->image = $filename;
                Image::make($image)->save($location);
            }
            $sell->account = $request->account;
            $sell->info = $request->info;
            $sell->status = 1;
            $sell->save();
            return redirect()->route('home')->with("success", "  Your Coin Sale Was Successful");
        }
        abort(404);
    }


    public function exchange()
    {
        $get['page_title'] = "Exchange Currency";
        $get['currency'] = Currency::whereStatus(1)->orderBy('name', 'asc')->get();
        $get['currency2'] = Currency::whereStatus(1)->orderBy('name', 'asc')->get();
        return view('user.exchange', $get);
    }

    public function exchangewallet(Request $request)
    {
        $this->validate($request, [
            'radio2' => 'required',
        ], [
            'radio2.required' => 'Please select a method of payment '
        ]);
        $auth = Auth::user();
        $basic = GeneralSettings::first();
        $hwallet = Cryptowallet::whereUser_id($auth->id)->whereCoin_id($request->hcoin)->first();
        $gwallet = Cryptowallet::whereUser_id($auth->id)->whereCoin_id($request->gcoin)->first();
        $trx = rand(000000, 999999) . rand(000000, 999999);

        $lenght = strlen($request->radio);
        if ($hwallet->balance < $request->hhave) {
            return back()->with("alert", "You dont have enough balance in your " . $hwallet->name . " wallet");
        }

        if ($request->radio2 == 0) {
            if ($gwallet->address == "0") {
                return back()->with("alert", "Please setup your payment account first before your make exchange");
            }
        }

        if ($request->gcoin == $request->hcoin) {
            return back()->with("alert", "You cant exchange the same type of coin. Please check and try again later");
        }

        if ($request->radio2 == 0) {
            $hwallet->balance = $hwallet->balance - $request->hhave;
            $gwallet->balance = $gwallet->balance + $request->gget;
            $hwallet->save();
            $gwallet->save();
        } else {
            $hwallet->balance = $hwallet->balance - $request->hhave;
            $hwallet->save();
        }


        $data['user_id'] = Auth::id();
        $data['trx'] = $trx;
        $data['transaction_number'] = $trx;
        if ($request->radio2 == 0) {
            $data['info'] = "" . $basic->sitename . " Wallet";
            $data['status'] = 2;
        } else {
            $data['info'] = $hwallet->address;
            $data['status'] = 1;
        }

        $data['from_amount'] = round($request->hhave, 6);
        $data['from_amount_charge'] = $request->charge;
        $data['from_currency_id'] = $request->hcoin;
        $data['receive_amount'] = round($request->gget, 6);
        $data['receive_currency_id'] = $request->gcoin;

        $data['type'] = 0;
        $getTrx = ExchangeMoney::create($data)->trx;


        Trx::create([
            'user_id' => $auth->id,
            'amount' => $request->hamount,
            'main_amo' => round($auth->balance, $basic->decimal),
            'charge' => $request->charge,
            'type' => '-',
            'action' => 'Exchange',
            'title' => ' Exchange ' . $request->unithave . ' ' . $hwallet->name,
            'trx' => $trx
        ]);


        Message::create([
            'user_id' => $auth->id,
            'title' => 'Coin Exchanged',
            'details' => 'Your ' . $request->hhave . '' . $hwallet->name . ' cryptocurrency exchange was successful. ' . $request->gget . '' . $gwallet->name . ' will be credited to your ' . $gwallet->name . ' wallet. Please wait while our server verify your exchange. Your account will be credited once coin exchange is confirmed by our server, Thank you for choosing ' . $basic->sitename . '',
            'admin' => 1,
            'status' => 0
        ]);


        $txt = $request->hhave . ' ' . $hwallet->name . ' Exchange Amount  ';
        return redirect()->route('home')->with("success", "  Your coin sales was successful");

    }


    public function exchangeonline(Request $request)
    {
        $this->validate($request, [
            'radio2' => 'required',
        ], [
            'radio2.required' => 'Please select a method of payment '
        ]);
        $auth = Auth::user();
        $basic = GeneralSettings::first();
        $hwallet = Cryptowallet::whereUser_id($auth->id)->whereCoin_id($request->hcoin)->first();
        $gwallet = Cryptowallet::whereUser_id($auth->id)->whereCoin_id($request->gcoin)->first();
        $trx = rand(000000, 999999) . rand(000000, 999999);

        $lenght = strlen($request->radio);

        if ($request->radio2 == 0) {
            if ($gwallet->address == "0") {
                return back()->with("alert", "Please setup your payment account first before your make exchange");
            }
        }

        if ($request->gcoin == $request->hcoin) {
            return back()->with("alert", "You cant exchange the same type of coin. Please check and try again later");
        }


        $data['user_id'] = Auth::id();
        $data['trx'] = $trx;
        $data['transaction_number'] = $request->account;
        if ($request->radio2 == 0) {
            $data['info'] = "" . $basic->sitename . " Wallet";
        } else {
            $data['info'] = $hwallet->address;
        }
        $data['status'] = 1;

        $data['type'] = 1;
        $data['from_amount'] = round($request->hhave, 6);
        $data['from_amount_charge'] = $request->charge;
        $data['from_currency_id'] = $request->hcoin;
        $data['receive_amount'] = round($request->gget, 6);
        $data['receive_currency_id'] = $request->gcoin;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $request->account . '.jpg';
            $location = 'exchange/' . $filename;
            $data['image'] = $filename;
            Image::make($image)->save($location);
        }
        $getTrx = ExchangeMoney::create($data)->trx;


        Trx::create([
            'user_id' => $auth->id,
            'amount' => $request->hamount,
            'main_amo' => round($auth->balance, $basic->decimal),
            'charge' => $request->charge,
            'type' => '-',
            'action' => 'Exchange',
            'title' => ' Exchange ' . $request->unithave . ' ' . $hwallet->name,
            'trx' => $trx
        ]);


        Message::create([
            'user_id' => $auth->id,
            'title' => 'Coin Exchanged',
            'details' => 'Your ' . $request->hhave . '' . $hwallet->name . ' cryptocurrency exchange was successful. ' . $request->gget . '' . $gwallet->name . ' will be credited to your ' . $gwallet->name . ' wallet. Please wait while our server verify your exchange. Your account will be credited once coin exchange is confirmed by our server, Thank you for choosing ' . $basic->sitename . '',
            'admin' => 1,
            'status' => 0
        ]);

        $auth = Auth::user();
        $exchange = ExchangeMoney::where('transaction_number', $request->account)->where('user_id', $auth->id)->whereStatus(0)->first();
        $basic = GeneralSettings::first();


        return redirect()->route('home')->with("success", "  Your Exchange Request Was Successful. Please wait while our server verify your transaction");

    }


    public function transactions()
    {
        $auth = Auth::user();
        $data['page_title'] = "My Trade";
        $data['sell'] = Trx::where('user_id', $auth->id)->whereType(0)->latest()->get();
        $data['buy'] = Trx::where('user_id', $auth->id)->latest()->whereType(1)->get();

        return view('user.mytrade', $data);

    }


    public function notifications()
    {
        $auth = Auth::user();
        $data['page_title'] = "Notifications";
        $data['notify'] = Post::whereNotify(1)->latest()->get();
        return view('user.notifications', $data);
    }


    public function inbox()
    {
        $auth = Auth::user();
        $data['page_title'] = "Inbox";
        $data['inbox'] = Message::where('user_id', $auth->id)->whereAdmin(1)->orderBy('created_at', 'desc')->paginate(6);
        $data['sent'] = Message::where('user_id', $auth->id)->whereAdmin(0)->orderBy('created_at', 'desc')->count();
        $data['total'] = Message::where('user_id', $auth->id)->whereAdmin(1)->orderBy('created_at', 'desc')->count();
        $data['unread'] = Message::where('user_id', $auth->id)->whereAdmin(1)->whereView(0)->orderBy('created_at', 'desc')->count();
        $data['read'] = Message::where('user_id', $auth->id)->whereAdmin(1)->whereView(1)->orderBy('created_at', 'desc')->count();
        $data['count'] = Message::where('user_id', $auth->id)->whereStatus(0)->whereAdmin(1)->orderBy('created_at', 'desc')->count();
        return view('user.inbox', $data);
    }


    public function sent()
    {
        $auth = Auth::user();
        $data['page_title'] = "Sent";
        $data['inbox'] = Message::where('user_id', $auth->id)->whereAdmin(0)->orderBy('created_at', 'desc')->paginate(6);
        $data['sent'] = Message::where('user_id', $auth->id)->whereAdmin(0)->orderBy('created_at', 'desc')->count();
        $data['total'] = Message::where('user_id', $auth->id)->whereAdmin(0)->orderBy('created_at', 'desc')->count();
        $data['unread'] = Message::where('user_id', $auth->id)->whereAdmin(0)->whereView(0)->orderBy('created_at', 'desc')->count();
        $data['read'] = Message::where('user_id', $auth->id)->whereAdmin(0)->whereView(1)->orderBy('created_at', 'desc')->count();
        $data['count'] = Message::where('user_id', $auth->id)->whereStatus(0)->whereAdmin(1)->orderBy('created_at', 'desc')->count();
        return view('user.inbox', $data);
    }


    public function inboxview($id)
    {
        $auth = Auth::user();
        $data['page_title'] = "Inbox View";
        $data['inbox'] = Message::where('user_id', $auth->id)->whereId($id)->first();
        $inbox = Message::where('user_id', $auth->id)->whereId($id)->first();

        $inbox->status = 1;
        $inbox->save();
        return view('user.inbox-view', $data);
    }


    public function inboxdelete($id)
    {
        $auth = Auth::user();
        $data['page_title'] = "Inbox Delete";
        $data['inbox'] = Message::where('user_id', $auth->id)->whereId($id)->first();
        $inbox = Message::where('user_id', $auth->id)->whereId($id)->first();
        $inbox->delete();
        return back()->with("message", "Message Deleted successfully");
    }


    public function messages()
    {
        $data['page_title'] = "Create Message";
        $data['code'] = strtoupper(Str::random(6));
        return view('user.create_message', $data);
    }


    public function postmessage(Request $request)
    {
        $data['user_id'] = Auth::id();
        $data['title'] = $request->subject;
        $data['details'] = $request->body;
        $data['status'] = 0;
        if ($request->hasFile('image')) {

            $this->validate($request,
                [
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
                ]);


            $data['image'] = uniqid() . '.jpg';
            $request->image->move('uploads/messages', $data['image']);
        }


        Message::create($data);

        return back()->with("message", "Message sent successfully");
    }


    public function usertest()
    {
        $data['page_title'] = "Create Testimonial";
        $data['code'] = strtoupper(Str::random(6));
        return view('user.create_testimonial', $data);
    }


    public function posttestimonial(Request $request)
    {
        $data['user_id'] = Auth::id();
        $data['details'] = $request->body;
        $data['code'] = $request->code;
        $data['status'] = 0;

        Testimonial::create($data);

        return back()->with("message", "Your testimonial has been created successfully. Your testimonial will appear on the front page once testimonial is approved");
    }


    public function newinvest()
    {

        $data['page_title'] = "New Investment";
        $data['plans'] = Plan::where('status', 1)->latest()->get();

        return view('user.new-invest', $data);
    }


    public function newcoinvest($id)
    {

        $data['page_title'] = "New Investment";
        $data['plan'] = Plan::where('status', 1)->whereId($id)->first();
        $data['wallets'] = UserWallet::where('user_id', Auth::id())->whereType('interest_wallet')->get();
        $baseUrl = "https://blockchain.info/";
        $endpoint = "tobtc?currency=USD&value=1";
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

        $data['btcrate'] = json_decode(curl_exec($ch), true);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        curl_close($ch);


        return view('user.new-investment', $data);
    }


    public function coinvest()
    {
        $data['page_title'] = "Investment Plan";
        $data['plans'] = Plan::where('status', 1)->latest()->get();
        $data['wallets'] = UserWallet::where('user_id', Auth::id())->whereType('interest_wallet')->get();
        $data['earn'] = UserWallet::whereType('interest_wallet')->where('user_id', Auth::id())->first();
        $data['trans'] = Invest::where('user_id', Auth::id())->where('status' ,'<', '2')->latest()->get();
        $data['invcount'] = Invest::where('user_id', Auth::id())->latest()->count();
        $data['invcomplete'] = Invest::where('user_id', Auth::id())->where('status', '!=', 1)->latest()->count();
        $data['invsum'] = Invest::where('user_id', Auth::id())->sum('amount');
        $basic = GeneralSettings::first();

        $baseUrl = "https://blockchain.info/";
        $endpoint = "tobtc?currency=USD&value=1";
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

        $data['btcrate'] = json_decode(curl_exec($ch), true);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        curl_close($ch);

        $baseUrl = "https://api.coingate.com";
        $endpoint = "/v2/rates/merchant/USD/$basic->currency";
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

        $data['usdrate'] = json_decode(curl_exec($ch), true);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);


        return view('user.invest', $data);
    }


    public function coinvestyield($id)
    {
        $data['page_title'] = "Investment Yield";
        $data['invest'] = Invest::where('user_id', Auth::id())->whereId($id)->first();
        $data['plans'] = Plan::where('id', $data['invest']->plan_id)->first();
        $data['earn'] = UserWallet::whereType('interest_wallet')->where('user_id', Auth::id())->first();
        $data['trans'] = Investyield::where('user_id', Auth::id())->whereInvest_id($id)->paginate(10);

        $baseUrl = "https://blockchain.info/";
        $endpoint = "tobtc?currency=USD&value=1";
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

        $data['btcrate'] = json_decode(curl_exec($ch), true);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        curl_close($ch);


        return view('user.investyield', $data);
    }


    public function withdrawinvest()
    {
        $data['page_title'] = "Investment Withdrawal";
        $user = Auth::user();
        $baseUrl = "https://blockchain.info/";
        $endpoint = "tobtc?currency=USD&value=1";
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

        $data['btcrate'] = json_decode(curl_exec($ch), true);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        curl_close($ch);
        $data['pdep'] = Deposit::whereUser_id($user->id)->whereStatus(0)->sum('amount');
        $data['tdep'] = Deposit::whereUser_id($user->id)->whereStatus(1)->sum('amount');
        $data['pdepositlog'] = Deposit::whereUser_id($user->id)->whereStatus(2)->get();
        $data['pwithdrawlog'] = WithdrawLog::whereUser_id($user->id)->whereStatus(1)->get();
        $data['pwith'] = WithdrawLog::whereUser_id($user->id)->whereStatus(1)->sum('amount');
        $data['twith'] = WithdrawLog::whereUser_id($user->id)->whereStatus(2)->sum('amount');
        $data['activeinv'] = Invest::whereUser_id($user->id)->whereStatus(1)->count();
        $data['endinv'] = Invest::whereUser_id($user->id)->whereStatus(0)->count();
        $data['withdrawgate'] = WithdrawMethod::whereStatus(1)->get();
        $data['investment'] = UserWallet::where('user_id', Auth::id())->where('type', 'interest_wallet')->first();
        $data['page_title'] = "Withdraw Investment";
        $data['gates'] = Gateway::whereStatus(1)->orderBy('name', 'asc')->get();
        return view('user.withdrawvest', $data);
    }


    public function buyPlan(Request $request)
    {

        $request->validate([
            'amount' => 'required|min:0',
            'plan_id' => 'required',
            'wallet_type' => 'required',
        ]);


        $baseUrl = "https://blockchain.info/";
        $endpoint = "tobtc?currency=USD&value=1";
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

        $btcrate = json_decode(curl_exec($ch), true);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        curl_close($ch);

        $btc = $request->amount * $btcrate;
        $user = User::find(Auth::id());
        $gnl = GeneralSettings::first();
        $basic = GeneralSettings::first();


        $baseUrl = "https://api.coingate.com";
        $endpoint = "/v2/rates/merchant/USD/$basic->currency";
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

        $localrate = json_decode(curl_exec($ch), true);
        $payamount = $localrate * $request->amount;

        $plan = Plan::where('id', $request->plan_id)->where('status', 1)->first();
        if (!$plan) {
            return back()->with("danger", "Invalid Plan Selected!");
        }

        if ($plan->fixed_amount == '0') {
            if ($request->amount < $plan->minimum) {
                $notify = ['error', 'Minimum Invest ' . number_format($plan->minimum) . ' ' . $gnl->cur_text];
                return back()->with("danger", "The Minimum Investment Amount Is $" . number_format($plan->minimum));
            }

            if ($request->amount > $plan->maximum) {

                return back()->with("danger", "The Minimum Investment Amount Is $" . number_format($plan->maximum));
            }
        } else {

            if ($request->amount != $plan->fixed_amount) {

                return back()->with("danger", "The Investment Amount must be exactly $" . number_format($plan->fixed_amount));
            }
        }


        if ($request->wallet_type == 1982100101281) {
            $userWallet = User::find(Auth::id());
        } elseif ($request->wallet_type < 200000000) {
            $userWallet = UserWallet::where('user_id', Auth::id())->where('id', $request->wallet_type)->first();
        }


        if ($request->wallet_type == 82718271565131) {
            $userWallet = User::find(Auth::id());

            $user = User::find(Auth::id());
            $gnl = GeneralSettings::first();

            $plan = Plan::where('id', $request->plan_id)->where('status', 1)->first();
            if (!$plan) {
                return back()->with("danger", "Invalid Plan Selected!");
            }

            if ($plan->fixed_amount == '0') {
                if ($request->amount < $plan->minimum) {
                    $notify = ['error', 'Minimum Invest ' . number_format($plan->minimum) . ' ' . $gnl->cur_text];
                    return back()->with("danger", "The Minimum Investment Amount Is $" . number_format($plan->minimum));
                }

                if ($request->amount > $plan->maximum) {

                    return back()->with("danger", "The Minimum Investment Amount Is $" . number_format($plan->maximum));
                }
            } else {

                if ($request->amount != $plan->fixed_amount) {

                    return back()->with("danger", "The Investment Amount must be exactly $" . number_format($plan->fixed_amount));
                }
            }


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

            if ($plan->fixed_amount == 0) {

                if ($plan->minimum <= $request->amount && $plan->maximum >= $request->amount) {
                    $invest['user_id'] = $user->id;
                    $invest['plan_id'] = $plan->id;
                    $invest['amount'] = $request->amount;
                    $invest['interest'] = $interest_amount;
                    $invest['period'] = $period;
                    $invest['time_name'] = $time_name->name;
                    $invest['hours'] = $plan->times;
                    $invest['btcvalue'] = $request->amount * $btcrate;
                    $invest['next_time'] = Carbon::parse($now)->addHours($plan->times);
                    $invest['status'] = 101;
                    $invest['capital_status'] = $plan->capital_back_status;
                    $invest['trx'] = $trxx;
                    $a = Invest::create($invest);


                    Session::put('Track', $trxx);

                    return redirect()->route('paybtcnow')->with("success", "Package Selected Successfully. Please proceed to make ayment to Complete process");

                }

                return back()->with("danger", "Invalid wallet balance");

            } else {
                if ($plan->fixed_amount == $request->amount) {

                    $data['user_id'] = $user->id;
                    $data['plan_id'] = $plan->id;
                    $data['amount'] = $request->amount;
                    $data['interest'] = $interest_amount;
                    $data['period'] = $period;
                    $data['time_name'] = $time_name->name;
                    $data['hours'] = $plan->times;
                    $invest['btcvalue'] = $request->amount * $btcrate;
                    $data['next_time'] = Carbon::parse($now)->addHours($plan->times);
                    $data['status'] = 101;
                    $data['capital_status'] = $plan->capital_back_status;
                    $data['trx'] = $trxx;
                    $a = Invest::create($data);


                    Session::put('Track', $trxx);

                    return redirect()->route('paybtcnow')->with("success", "Package Selected Successfully. Please proceed to make ayment to Complete process");
                }

                return back()->with("danger", "Something went wrong");
            }


        }

        if (!$userWallet) {
            return back()->with("danger", "invalid wallet selected");
        }


        if ($payamount > $userWallet->balance) {
            return back()->with("danger", "Insufficient wallet balance");
        }

        $time_name = TimeSetting::where('time', $plan->times)->first();
        $now = Carbon::now();

        $new_balance = $userWallet->balance - $payamount;
        $userWallet->balance = $new_balance;
        $userWallet->save();

        //start
        if ($plan->interest_status == 1) {
            $interest_amount = ($request->amount * $plan->interest) / 100;
        } else {
            $interest_amount = $plan->interest;
        }
        $period = ($plan->lifetime_status == 1) ? '-1' : $plan->repeat_time;
        //end

        if ($plan->fixed_amount == 0) {

            if ($plan->minimum <= $request->amount && $plan->maximum >= $request->amount) {
                $invest['user_id'] = $user->id;
                $invest['plan_id'] = $plan->id;
                $invest['amount'] = $request->amount;
                $invest['interest'] = $interest_amount;
                $invest['period'] = $period;
                $invest['time_name'] = $time_name->name;
                $invest['hours'] = $plan->times;
                $invest['btcvalue'] = $request->amount * $btcrate;
                $invest['next_time'] = Carbon::parse($now)->addHours($plan->times);
                $invest['status'] = 1;
                $invest['capital_status'] = $plan->capital_back_status;
                $invest['trx'] = rand(000000, 999999) . rand(000000, 999999);
                $a = Invest::create($invest);


                return redirect()->route('coinvest')->with("success", "Investment successful");
            }

            return back()->with("danger", "Invalid wallet balance");

        } else {
            if ($plan->fixed_amount == $request->amount) {

                $data['user_id'] = $user->id;
                $data['plan_id'] = $plan->id;
                $data['amount'] = $request->amount;
                $data['interest'] = $interest_amount;
                $data['period'] = $period;
                $data['time_name'] = $time_name->name;
                $data['hours'] = $plan->times;
                $invest['btcvalue'] = $request->amount * $btcrate;
                $data['next_time'] = Carbon::parse($now)->addHours($plan->times);
                $data['status'] = 1;
                $data['capital_status'] = $plan->capital_back_status;
                $data['trx'] = rand(000000, 999999) . rand(000000, 999999);
                $a = Invest::create($data);


                $user->save();

                return redirect()->route('coinvest')->with("success", "Package Purchased Successfully Complete");
            }

            return back()->with("danger", "Something went wrong");
        }


    }

    public function paybtcnow()
    {
        $page_title = 'Pay BTC';
        $track = Session::get('Track');
        $baseUrl = "https://blockchain.info/";
        $endpoint = "tobtc?currency=USD&value=1";
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

        $btcrate = json_decode(curl_exec($ch), true);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        curl_close($ch);


        $invest = Invest::where('user_id', Auth::id())->whereTrx($track)->first();
        $currency = Currency::whereId(5)->first();
        return view('user.paybtcnow', compact('page_title', 'btcrate', 'invest', 'currency'));
    }


    public function interestLog()
    {
        $page_title = 'Interest Log';
        $trans = Investyield::where('user_id', Auth::id())->wherelatest()->paginate(15);
        return view(activeTemplate() . 'user.interest_log', compact('page_title', 'trans'));
    }

    public function btcpaynowupload(Request $request)
    {
        $this->validate($request,
            [
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'trxx' => 'required',
                'btc' => 'required',
            ]);

        $basic = GeneralSettings::first();
        $data = Invest::where('status', 101)->where('trx', $request->trx)->first();
        $auth = Auth::user();

        $data->tnum = $request->trxx;
        $data->btcwallet = $request->btc;
        $data->status = 2;
        if ($request->hasFile('photo')) {
            $data['image'] = uniqid() . '.jpg';
            $request->photo->move('uploads/payments', $data['image']);
        }


        Message::create([
            'user_id' => $auth->id,
            'title' => 'Investment Plan Created',
            'details' => 'Your bitcoin investent of USD' . $data->amount . '  with transaction number ' . $data->trx . ' was successful. Please wait while our server verifies your payment. Your investment will be started once payment is confirmed by our server, Thank you for choosing ' . $basic->sitename . '',
            'admin' => 1,
            'status' => 0
        ]);

        $data->save();
        return redirect()->route('coinvest')->with("success", "  Your investment plan was successfully sent for confirmation");

    }


    public function refMy()
    {
        $page_title = "My Referral";

        $trans = CommissionLog::with('user', 'bywho')->where('user_id', Auth::id())->latest()->paginate(15);
        return view(activeTemplate() . 'user.my_referral', compact('page_title', 'trans'));


    }

     public function vxvault()
    {
        $data['page_title'] = "VX Vault";
        return view('user.vxvault.vxlock', $data);
    }




}
