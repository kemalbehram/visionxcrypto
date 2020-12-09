<?php

namespace App\Http\Controllers\Api;

use App\GeneralSettings;
use App\Internet;
use App\Network;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        $content = json_decode(curl_exec( $ch ),true);
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

}
