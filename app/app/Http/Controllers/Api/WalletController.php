<?php

namespace App\Http\Controllers\Api;

use App\GeneralSettings;
use App\Http\Controllers\Controller;
use App\UserWallet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    function createwallet(Request $request)
    {
        try {

            $type = $request->type;

            $user = Auth::user();

            $basic = GeneralSettings::first();
            if ($request->type == "BTC") {
                $akey = $basic->bitcoin_address;
            } elseif ($request->type == "ETH") {
                $akey = $basic->etherum_address;
            }

            $password = "visionxcrypto";
            $label = $user->username;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://coinremitter.com/api/v3/' + $type + '/get-new-address',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('api_key' => $akey, 'password' => $password, 'label' => $label),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $rep = json_decode($response, true);

            UserWallet::create([
                'user_id' => $user->id,
                'balance' => 0,
                'type' => $type,
                'address' => $rep['data']['address'],
                'label' => $rep['data']['label'],
            ]);

            return response()->json(['status' => 1, 'message' => "Wallet created successfully"]);
        } catch (Exception $e) {
            return response()->json(['status' => 0, 'message' => "Error while creating wallet"]);
        }
    }

    function receivecoin($type)
    {
        $wallet = UserWallet::where([['user_id', Auth::id()], ['type', $type]])->find();

        if ($wallet == null) {
            return response()->json(['status' => 0, 'message' => "Address not found"]);
        }

        return response()->json(['status' => 1, 'message' => "Address not found", 'data' => $wallet->address]);
    }

    function fetchwallets()
    {
        $wallet = UserWallet::where('user_id', Auth::id())->get();

        if ($wallet == null) {
            return response()->json(['status' => 0, 'message' => "Wallets not found"]);
        }

        return response()->json(['status' => 1, 'message' => "Wallets fetched successfully", 'data' => $wallet]);
    }
}
