<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Deposit;
use Illuminate\Support\Str;
use App\GeneralSettings;

class CallbackController extends Controller
{

 

    public function index(Request $request)
    {
        $input = $request->all();
        $u = User::where('account_number', $input['craccount'])->first();
        $basic = GeneralSettings::first();
        $total = $input['amount'] - $basic->depocharge;
        $trx = strtoupper(str_random(20));

        if ($u) {
            $u->balance += $total;
            $u->save();
            
            
             $depo['user_id'] = $u->id;
             $depo['gateway_id'] = 0;
             $depo['amount'] = $input['amount'];
             $depo['charge'] = $basic->depocharge;
             $depo['usd'] = 0;
             $depo['trx'] = $trx;
             $depo['status'] = 1;
             Deposit::create($depo);
             
            return "Wallet Credited";
        }
        else{
            return "User not found";
        }
    }

}
