<?php

namespace App\Http\Controllers\Api;

use App\GeneralSettings;
use App\Http\Controllers\Controller;
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

            if ($basic->email_verification == 1) {
                $email_verify = 0;
            } else {
                $email_verify = 1;
            }

            if ($basic->sms_verification == 1) {
                $phone_verify = 0;
            } else {
                $phone_verify = 1;
            }
            if (isset($input['referBy'])) {
                $referUser = User::where('username', $input['referBy'])->first();
            }

            $accountname =$input['firstname'] . " " . $input['lastname'];


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://openapi.rubiesbank.io/v1/createvirtualaccount",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{\n    \"virtualaccountname\": \"$accountname\",\n    \"amount\": \"1\",\n    \"amountcontrol\": \"VARIABLEAMOUNT\",\n    \"daysactive\": 10000,\n    \"minutesactive\": 30,\n    \"callbackurl\": \"$basic->baseurl/api/callback1\"\n}",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: " . $basic->rubies_secretkey,
                    "Content-Type: application/json"
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $rep = json_decode($response, true);


            $verification_code = strtoupper(Str::random(6));
            $sms_code = strtoupper(Str::random(6));
            $email_time = Carbon::parse()->addMinutes(5);
            $phone_time = Carbon::parse()->addMinutes(5);

            $user = User::create([
                'fname' => $input['firstname'],
                'lname' => $input['lastname'],
                'email' => $input['email'],
                'timezone' => $basic->timezone,
                'phone' => $input['phone'],
                'account_number' => $rep['virtualaccount'],
                'username' => strtolower($input['username']),
                'refer' => isset($input['referBy']) ? $referUser->id : 0,
                'email_verify' => $email_verify,
                'verification_code' => $verification_code,
                'sms_code' => $sms_code,
                'email_time' => $email_time,
                'phone_verify' => $phone_verify,
                'phone_time' => $phone_time,
                'password' => Hash::make($input['password']),
            ]);

            UserWallet::create([
                'user_id' => $user->id,
                'balance' => 0,
                'type' => 'interest_wallet',
            ]);

            $basic = GeneralSettings::first();

            $code = strtoupper(Str::random(6));
            $user->phone_time = Carbon::now();
            $user->sms_code = $code;
            $user->save();
            send_sms($user->phone, $code);


            if ($basic->email_verification == 1) {
                $email_code = strtoupper(Str::random(6));
                $text = "Your Verification Code Is: <b>$email_code</b>";
                send_email_verification($user->email, $user->username, 'Email verification', $text);

                $user->verification_code = $email_code;
                $user->email_time = Carbon::parse()->addMinutes(5);
                $user->save();
            }

            if ($basic->sms_verification == 1) {
                $sms_code = strtoupper(Str::random(6));
                $txt = "Your%20phone%20verification%20code%20is:%20$sms_code";


                $user->sms_code = $sms_code;
                $user->phone_time = Carbon::parse()->addMinutes(1);
                $user->save();


                $baseUrl = "https://www.bulksmsnigeria.com/";
                $endpoint = "api/v1/sms/create?api_token=" . $basic->sms_token . "&from=" . $basic->sitename . "&to=" . $user->phone . "&body=" . $txt . "";
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
            }

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

            if (!Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
                return response()->json(['status' => 0, 'message' => "Invalid credentials. Try again with valid credentials"]);
            }

            $user = Auth::user();
            $token = Str::random(60);

            if ($user->status == 0) {
                return response()->json(['status' => 0, 'message' => 'Your account has been blocked! Kindly contact support']);
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

//                User::where(['id'=> auth()->user()->id])->update(['api_token' => $token]);

            return response()->json(['status' => 1, 'message' => "User authenticated successfully", 'token' => $token, 'balance' => $user->balance, 'first_name' => $user->fname, 'last_name' => $user->lname, 'profile_path' => 'https://ui-avatars.com/api/?name=' . substr($user->fname, 0, 2) . '&color=7F9CF5&background=EBF4FF']);

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
            $user = User::where('email', $input['email'])->first();

            if (!$user) {
                return response()->json(['status' => 0, 'message' => 'User does not exist']);
            }

            if ($user->sms_code != $input['code']) {
                return response()->json(['status' => 0, 'message' => 'Verification code did not match']);
            }

            $user->phone_verify = 1;
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
            $user = User::where('email', $input['email'])->first();

            if (!$user) {
                return response()->json(['status' => 0, 'message' => 'User does not exist']);
            }

            $basic = GeneralSettings::first();
            if ($basic->sms_verification == 1) {
                $txt = "Your%20phone%20verification%20code%20is:%20$user->sms_code";
                send_sms($user->phone, $txt);
            }

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
            $user = User::where('email', $input['email'])->orWhere('phone', $input['email'])->first();

            if (!$user) {
                return response()->json(['status' => 0, 'message' => 'User does not exist']);
            }

            $code = trim(substr(date('iym') . rand(), 0, 6));

            notify($user, "Verification Code", "Your verification code is " . $code);

            $user->sms_code = $code;
            $user->save();
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
            $user = User::where('email', $input['email'])->orWhere('phone', $input['email'])->first();

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

}