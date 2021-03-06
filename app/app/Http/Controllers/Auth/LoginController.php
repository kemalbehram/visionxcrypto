<?php

namespace App\Http\Controllers\Auth;

use App\GeneralSettings;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\UserLogin;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Etemplate;
use Illuminate\Http\Request;
use Auth;
use Mail;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'user/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function username()
    {
        return 'username';
    }

    public function authenticated(Request $request, $user)
    {
        if($user->status == 0){
            $this->guard()->logout();
            $notification =  array('message' => 'Sorry Your Account is Block Now.!','alert-type' => 'warning');
            return redirect('/')->with($notification);
        }

        $user_ip = request()->ip();
        $user_device = $_SERVER['HTTP_USER_AGENT'];
        $code = strtoupper(Str::random(6));

        if($user_device !=$user->web_device){
            $basic = GeneralSettings::first();
            $code = strtoupper(Str::random(6));

            send_smsTermi($user->phone,$code);
//            $baseUrl = "https://www.bulksmsnigeria.com/";
//            $endpoint = "api/v1/sms/create?api_token=" . $basic->sms_token . "&from=VISIONX&to=" . $user->phone . "&body=" . $code . "";
//            $httpVerb = "GET";
//            $contentType = "application/json"; //e.g charset=utf-8
//            $headers = array(
//                "Content-Type: $contentType",
//
//            );
//
//            $ch = curl_init();
//            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//            curl_setopt($ch, CURLOPT_URL, $baseUrl . $endpoint);
//            curl_setopt($ch, CURLOPT_HTTPGET, true);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
//            $content = json_decode(curl_exec($ch), true);
//            $err = curl_errno($ch);
//            $errmsg = curl_error($ch);
//            curl_close($ch);

          $content = "Sorry your account was just accessed from an unknown device\n " .$user_device. ".\n\n, <b><br>Your Verification Code Is $code. \n\n</b><br>If not you, kindly reset your account password.";
          $template = Etemplate::first();

          $message = $template->header.$content.$template->footer;
           $headers = array(
            'Authorization: Bearer '.$template->sendgrid,
            'Content-Type: application/json'
        );

        $datas = array(
            "personalizations" => array(
                array(
                    "to" => array(
                        array(
                            "email" => $user->email,
                            "name" => $user->username
                        )
                    )
                )
            ),
            "from" => array(
                "email" => 'no-reply@visionxcrypto.com'
            ),
            "subject" => 'Unauthorized Login',
            "content" => array(
                array(
                    "type" => "text/html",
                    "value" => $message
                )
            )
        );

        $ch = curl_init();
        curl_setopt($ch, CURLINFO_HEADER_OUT, true); // enable tracking
        curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datas));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $headerSent = curl_getinfo($ch, CURLINFO_HEADER_OUT); // request headers
        curl_close($ch);
        //return $response;

          // $body = $content;
          //    $data = array('name'=>"$user->username");
        //    Mail::send('mail', ['user' => $user, 'body' => $body], function ($m) use ($user, $body) {
        //    $m->from(env('MAIL_USERNAME'), 'Visionx');
        //    $m->to($user->email, $user->username)->subject('Suspicious Login Attempt');
        //    });
        //  }

        $time = Carbon::parse(Carbon::now())->addMinutes(30);
        $user->login_time = $time;
        $user->sms_code = $code;
        $user->save();

// Use JSON encoded string and converts
// it into a PHP variable

            $baseUrl = "http://www.geoplugin.net/";
			$endpoint = "json.gp?ip=" . $user_ip."";
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


             $conti = $content['geoplugin_continentName'];
             $country = $content['geoplugin_countryName'];
             $city = $content['geoplugin_city'];

        $ul['user_id'] = $user->id;
        $ul['user_ip'] =  request()->ip();
       if($city){
        $ul['location'] = ''.$conti.', '.$country.' , '.$city.'';
        }
        else{
        $ul['location'] = 'Unknown';
        }
     $ul['details'] = $_SERVER['HTTP_USER_AGENT'];
        UserLogin::create($ul);
    } }

    public function logout(Request $request)
    {
        Auth::guard()->logout();
        return redirect('/')->with('success','You have been logged out!!');
    }


}
