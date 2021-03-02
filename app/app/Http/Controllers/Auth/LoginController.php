<?php

namespace App\Http\Controllers\Auth;

use App\GeneralSettings;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\UserLogin;
use Carbon\Carbon;
use Illuminate\Support\Str;
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

        if($user_device !=$user->web_device){
            $basic = GeneralSettings::first();
            $code = strtoupper(Str::random(6));
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

          $content = "Sorry your account was just accessed from an unknown device<br> " .$user_device. ".<br>If this was you, please you can ignore this message or reset your account password.";
           $body = $content;
            $data = array('name'=>"$user->username");
            Mail::send('mail', ['user' => $user, 'body' => $body], function ($m) use ($user, $body) {
            $m->from(env('MAIL_USERNAME'), 'Visionx');
            $m->to($user->email, $user->username)->subject('Suspicious Login Attempt');
            });
          }

        $time = Carbon::parse(Carbon::now())->addMinutes(30);
        $user->login_time = $time;
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
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();
        return redirect('/')->with('success','You have been logged out!!');
    }


}
