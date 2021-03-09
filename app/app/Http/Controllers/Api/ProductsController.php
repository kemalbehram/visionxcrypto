<?php

namespace App\Http\Controllers\Api;

use App\Currency;
use App\GeneralSettings;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\Vxvault;
use App\Vxvaultwithdraw;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function listdata($network)
    {
        $user = Auth::user();

        $basic = GeneralSettings::first();

        $url="https://www.nellobytesystems.com/APIDatabundlePlansV1.asp";
        // Perform initialize to validate name on server
        $result = file_get_contents($url);
        $reps=json_decode($result, true);
        $rep=$reps['MOBILE_NETWORK'];


        if($network=="MTN") {
            $product=$rep['MTN'][0]['PRODUCT'];
        }

        if($network=="9MOBILE") {
            $product=$rep['9mobile'][0]['PRODUCT'];
        }

        if($network=="AIRTEL") {
            $product=$rep['Airtel'][0]['PRODUCT'];
        }

        if($network=="GLO") {
            $product=$rep['Glo'][0]['PRODUCT'];
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

        $vx=Vxvault::orderBy('id','desc')->whereStatus(1)->where('user_id', Auth::id())->sum('btc');

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
        $vaul = Vxvault::whereUser_id(Auth::id())->whereStatus(1)->where('paid','=',null)->limit(3)->get();
        foreach ($vaul as $v ){
            $t=Carbon::parse($v->expire)->diffInSeconds(Carbon::now(),  false);
            if($t>=15){
                $expire=true;
            }else{
                $expire=false;
            }
            $v['estatus']=$expire;
        }

        $history = Vxvaultwithdraw::join('vxvaults', 'vxvaults.invoiceid','vxvaultwithdraws.invoiceid')->select('vxvaultwithdraws.*', 'vxvaults.usd' )->orderBy('id','desc')->get();

        if($vaul->isEmpty()){
            return response()->json(['status' => 0, 'message' => 'Vault does not exist']);
        }
        return response()->json(['status' => 1, 'message' => 'Coinlocks fetched successfully', 'vault'=>$vaul, 'history'=>$history]);
    }

    public function coinrate(){
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

        $btcrate= json_decode(curl_exec($ch), true);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        curl_close($ch);

        $basic = GeneralSettings::first();

        return response()->json(['status' => 1, 'message' => 'Coin Rates fetched successfully', 'btc'=>number_format($btcrate*1,10), 'ngn'=>number_format($basic->rate*1,2)]);

    }

}
