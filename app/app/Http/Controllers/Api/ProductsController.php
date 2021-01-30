<?php

namespace App\Http\Controllers\Api;

use App\Currency;
use App\GeneralSettings;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\Vxvault;
use App\Vxvaultwithdraw;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function listdata($network)
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


        if($network=="MTN") {
            $product=$rep['MTN'];
        }

        if($network=="9MOBILE") {
            $product=$rep['9MOBILE'];
        }

        if($network=="AIRTEL") {
            $product=$rep['AIRTEL'];
        }

        if($network=="GLO") {
            $product=$rep['GLO'];
        }

        return response()->json(['status' => 1, 'message' => 'Internet data plans fetched successfully', 'data'=>$product]);
    }


    public function listTv($tv)
    {

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

        $content = json_decode(curl_exec( $ch ));
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        curl_close($ch);


        $tvid = $content->TV_ID;

        if($tv=="DSTV") {
            $plan = $tvid->DStv;
        }

        if($tv=="GOTV") {
            $plan = $tvid->GOtv;
        }

        if($tv=="STARTIMES") {
            $plan = $tvid->Startimes;
        }

        return response()->json(['status' => 1, 'message' => 'TV plans fetched successfully', 'data'=>$plan[0]->PRODUCT]);
    }

    public function listBanks()
    {
        $user = Auth::user();

//        if($user->bankyes != 1){
//            return redirect()->route('verification')->with("danger", "Please setup your payment bank account first before you proceed with bank transfer");
//        }

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
        $data=json_decode($response, true);

        return response()->json(['status' => 1, 'message' => 'Banks fetched successfully', 'data'=>$data]);
    }

    public function myBank()
    {
        $user = Auth::user();

        if($user->bank==""){
            return response()->json(['status' => 0, 'message' => 'Sorry, no Account details is found']);
        }

        $bank_name=$user->bank;
        $bank_code=$user->bankcode;
        $account_name=$user->accountname;
        $account_no=$user->accountno;

        $basic = GeneralSettings::first();

        return response()->json(['status' => 1, 'message' => 'Banks fetched successfully', 'bank_name'=>$bank_name, 'bank_code'=>$bank_code, 'account_name'=>$account_name, 'account_no'=>$account_no, 'charges' => $basic->transcharge * 1]);
    }

    public function myBalance()
    {
        $user = Auth::user();

        $vx=Vxvault::orderBy('id','desc')->whereStatus(0)->where('user_id', Auth::id())->sum('amount');

        return response()->json(['status' => 1, 'message' => 'Balances fetched successfully', 'naira'=>round($user->balance), 'investment'=>'0', 'coinlock'=>$vx, 'referral'=>"$user->bonus",]);
    }

    public function getRate($currencyid, $type)
    {
        $cur=Currency::find($currencyid);

        if(!$cur){
            return response()->json(['status' => 0, 'message' => 'Invalid params']);
        }

        if($type=="sell"){
            $rate=$cur->sell;
        }else{
            $rate=$cur->buy;
        }

        return response()->json(['status' => 1, 'message' => 'Rates fetched successfully', 'rate'=>$rate*1]);
    }

    public function coinlocks()
    {
        $vault = Vxvault::orderBy('id','desc')->get();
        $history = Vxvaultwithdraw::orderBy('id','desc')->get();
        return response()->json(['status' => 1, 'message' => 'Coinlocks fetched successfully', 'vault'=>$vault, 'history'=>$history]);
    }

}
