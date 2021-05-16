<?php

namespace App\Http\Controllers\Api;

use App\GeneralSettings;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use App\UserLogin;
use App\UserWallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthenticateController extends Controller
{
    public function signup(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => 'required|email',
            'username' => 'required|string',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'password' => 'required|min:6|max:20',
            'phone' => 'required|min:11|max:11');

        $messages = array(
            'min' => 'Hmm, that looks short.',
            'max' => 'Oops, that too long.',
            'alpha_num' => 'Use alphabet or alphabet with numbers to secure your password.');

        $cm = [
            'firstname.required' => 'First Name  must not be  empty!!',
            'lastname.required' => 'Last Name  must not be  empty!!',
            'phone.required' => 'Contact Number is required!!',
            'email.required' => 'Email Address must not be  empty!!',
            'username.required' => 'username must not be  empty!!',
        ];


        $validator = Validator::make($input, $rules, $messages);

        if ($validator->passes()) {
//            try
//            {


            $email = User::where('email', $input['email'])->exists();
            if ($email) {
                return response()->json(['status' => 0, 'message' => 'Email has been taken']);
            }

            $phone = User::where('phone', $input['phone'])->exists();
            if ($phone) {
                return response()->json(['status' => 0, 'message' => 'Phone number has been taken']);
            }

            $username = User::where('username', $input['username'])->exists();
            if ($username) {
                return response()->json(['status' => 0, 'message' => 'Username has been taken']);
            }

            $basic = GeneralSettings::first();

            $email_verify = 0;
            $phone_verify = 0;

            if (isset($input['referBy'])) {
                $referUser = User::where('username', $input['referBy'])->first();
            }

            $verification_code = substr(rand(),0,6);
            $email_time = Carbon::parse()->addMinutes(5);
            $phone_time = Carbon::parse()->addMinutes(5);

            $user = User::create([
                'fname' => $input['firstname'],
                'lname' => $input['lastname'],
                'email' => $input['email'],
                'timezone' => $basic->timezone,
                'phone' => $input['phone'],
                'account_number' => rand(),
                'username' => strtolower($input['username']),
                'refer' => isset($input['referBy']) ? $referUser->id : 0,
                'email_verify' => $email_verify,
                'verification_code' => $verification_code,
                'sms_code' => $verification_code,
                'email_time' => $email_time,
                'phone_verify' => $phone_verify,
                'phone_time' => $phone_time,
                'password' => Hash::make($input['password']),
            ]);

            $text = "Your Verification Code is $verification_code";
            send_email_sendgrid($user, "Email verification", $text);

            $txt = "Your%20phone%20verification%20code%20is:%20$verification_code";
//            send_bulksmsnigeria($user->phone,$txt);
            send_smsTermi($user->phone,$verification_code);


            return response()->json(['status' => 1, 'message' => "Account created successfully"]);

//            }catch(\Exception $e){
//                DB::rollback();
//                //dd($e);
//                return response()->json(['status'=> 0, 'message'=>'Error creating account','error' => $e]);
//            }
        } else {
            DB::rollback();
            return response()->json(['status' => 0, 'message' => 'Error creating account', 'error' => $validator->errors()]);
        }
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => 'required',
            'password' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if ($validator->passes()) {

            if (!Auth::attempt(['email' => request('email'), 'password' => request('password')]) && !Auth::attempt(['username' => request('email'), 'password' => request('password')])) {
                if (!Auth::attempt(['phone' => request('email'), 'password' => request('password')]) && !Auth::attempt(['username' => request('email'), 'password' => request('password')])) {
                    return response()->json(['status' => 0, 'message' => "Invalid credentials. Try again with valid credentials"]);
                }
            }


            $user = Auth::user();
            $token = Str::random(60);

            if ($user->status == 0) {
                return response()->json(['status' => 0, 'message' => 'Your account has been blocked! Kindly contact support']);
            }

            if ($user->phone_verify != 1) {
                return response()->json(['status' => 2, 'message' => 'You have not verify your phone number', 'data'=>$user->phone]);
            }

            if ($user->email_verify != 1) {
                return response()->json(['status' => 0, 'message' => 'You have not verify your email address']);
            }

            $user->login_time = Carbon::now();
            $user->save();

            $user_ip = request()->ip();


// Use JSON encoded string and converts
// it into a PHP variable


            $baseUrl = "http://www.geoplugin.net/";
            $endpoint = "json.gp?ip=" . $user_ip . "";
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


            $conti = $content['geoplugin_continentName'];
            $country = $content['geoplugin_countryName'];
            $city = $content['geoplugin_city'];


            $ul['user_id'] = $user->id;
            $ul['user_ip'] = request()->ip();
            if ($city) {
                $ul['location'] = '' . $conti . ', ' . $country . ' , ' . $city . '';
            } else {
                $ul['location'] = 'Unknown';
            }
            $ul['details'] = $_SERVER['HTTP_USER_AGENT'];
            UserLogin::create($ul);


            $request->user()->forceFill([
                'api_token' => $token,
            ])->save();

            $noti=Message::where([['user_id', Auth::id()], ['status',0]])->orderBy('id', 'desc')->exists();

            $basic = GeneralSettings::first();

            if ($user->locked == 1) {
                return response()->json(['status' => 0, 'message' => 'Account has been locked for maximum pin attempt. Kindly contact support']);
            }

            $hour = date('H');
            $dayTerm = ($hour > 17) ? "Evening" : (($hour > 12) ? "Afternoon" : "Morning");
            $greet = "Good " . $dayTerm;

            $wallets = ["NGN", "BTC", "ETH", "USDT", "BNB", "DASH", "LTC"];

            foreach ($wallets as $wallet) {
                $w = UserWallet::where([["type", $wallet], ["user_id", $user->id]])->first();

                if ($w == null) {
                    UserWallet::create([
                        'user_id' => $user->id,
                        'balance' => 0,
                        'type' => $wallet,
                    ]);
                }
            }

            return response()->json(['status' => 1, 'message' => "User authenticated successfully", 'token' => $token, 'balance' => round($user->balance, 2), 'first_name' => $user->fname, 'last_name' => $user->lname, 'user_name' => $user->username, 'image' => $user->image, 'phone' => $user->phone, 'email' => $user->email, 'account_number' => $user->account_number, 'pin' => $user->withdrawpass, 'verified' => $user->verified, 'notification' => $noti, 'greet' => $greet]);

        } else {
            return response()->json(['status' => 0, 'message' => 'Unable to login with errors', 'error' => $validator->errors()]);
        }
    }

    public function verifycode(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'code' => 'required',
            'type' => 'required',
            'email' => 'required'
        );

        $validator = Validator::make($input, $rules);

        if ($validator->passes()) {
            $user = User::where('email', $input['email'])->orWhere('username', $input['email'])->first();

            if (!$user) {
                return response()->json(['status' => 0, 'message' => 'User does not exist']);
            }

            if ($user->sms_code != $input['code']) {
                return response()->json(['status' => 0, 'message' => 'Verification code did not match']);
            }

            $user->phone_verify = 1;
            $user->email_verify = 1;
            $user->save();
            return response()->json(['status' => 1, 'message' => 'Verified successfully']);

        } else {
            return response()->json(['status' => 0, 'message' => 'Unable to verify', 'error' => $validator->errors()]);
        }
    }

    public function resendcode(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => 'required'
        );

        $validator = Validator::make($input, $rules);

        if ($validator->passes()) {
            $user = User::where('email', $input['email'])->orWhere('username', $input['email'])->first();

            if (!$user) {
                return response()->json(['status' => 0, 'message' => 'User does not exist']);
            }

            $code = substr(rand(), 0, 6);

            $text = "Your Verification Code is $code";
            send_email_sendgrid($user, "Email verification", $text);

            $txt = "Your%20phone%20verification%20code%20is:%20$code";
//            send_bulksmsnigeria($user->phone, $txt);
            send_smsTermi($user->phone,$code);

            return response()->json(['status' => 1, 'message' => 'Code resent successfully']);

        } else {
            return response()->json(['status' => 0, 'message' => 'Error in request', 'error' => $validator->errors()]);
        }
    }

    public function forgotpassword(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => 'required'
        );

        $validator = Validator::make($input, $rules);

        if ($validator->passes()) {
            $user = User::where('email', $input['email'])->orWhere('username', $input['email'])->orWhere('phone', $input['email'])->first();

            if (!$user) {
                return response()->json(['status' => 0, 'message' => 'User does not exist']);
            }

            $code = substr(rand(), 0, 6);

            $text = "Your Verification Code is $code";
            send_email_sendgrid($user, "Email verification", $text);

            $txt = "Your%20phone%20verification%20code%20is:%20$code";
//            send_bulksmsnigeria($user->phone, $txt);
            send_smsTermi($user->phone,$code);

            return response()->json(['status' => 1, 'message' => 'Verification sent successfully']);

        } else {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }
    }

    public function forgotpassword_newpassword(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => 'required',
            'code' => 'required',
            'password' => 'required'
        );

        $validator = Validator::make($input, $rules);

        if ($validator->passes()) {
            $user = User::where('email', $input['email'])->orWhere('username', $input['email'])->orWhere('phone', $input['email'])->first();

            if (!$user) {
                return response()->json(['status' => 0, 'message' => 'User does not exist']);
            }


            if ($user->sms_code != $input['code']) {
                return response()->json(['status' => 0, 'message' => 'Verification code did not match']);
            }

            $user->password = Hash::make($input['password']);
            $user->save();
            return response()->json(['status' => 1, 'message' => 'Password set successfully']);

        } else {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }
    }

    public function getUser()
    {

        if (auth()->user()->status != 1) {
            $users = User::where('id', '=', auth()->user()->id)->first();
            return response()->json(['status' => 1, 'message' => 'User details generated successfully', 'data' => $users]);
        } else {
            return response()->json(['status' => 0, 'message' => 'Your account has been blocked! Kindly contact support']);
        }
    }

    public function updatepin(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'oldpin' => 'required',
            'newpin' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if ($validator->passes()) {
            $user =User::find(Auth::id());

            if ($user->withdrawpass != $input['oldpin']) {
                return response()->json(['status' => 0, 'message' => 'Old pin did not match']);
            }

            $user->withdrawpass = $input['newpin'];
            $user->save();

            Message::create([
                'user_id' => $user->id,
                'title' => 'Pin Changed',
                'details' => 'New Pin set successfully',
                'admin' => 1,
                'status' => 0
            ]);

            return response()->json(['status' => 1, 'message' => 'Pin set successfully']);


        } else {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }
    }

}
