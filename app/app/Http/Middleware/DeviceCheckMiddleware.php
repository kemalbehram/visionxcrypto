<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class DeviceCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user_device = $_SERVER['HTTP_USER_AGENT'];

        if($user_device !=Auth::user()->web_device){
            return redirect()->route('unauthorized');
        }

        return $next($request);
    }
}
