<?php

namespace App\Http\Controllers\Api;

use App\GeneralSettings;
use App\Verified;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VerificationController extends Controller
{
    public function level1(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'bvn' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $user = Auth::user();
        $basic = GeneralSettings::first();


        if ($basic->bvn > $user->balance) {
            return response()->json(['status' => 2, 'message' => 'Insufficient wallet balance. Please deposit more fund and try again']);
        }



        $trx = strtoupper(str_random(20));
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://openapi.rubiesbank.io/v1/verifybvn",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\n\t\"bvn\":\"$request->bvn\",\n\t\"reference\":\"$trx\"\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: ".$basic->rubies_secretkey,
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $rep=json_decode($response, true);

        if($rep['responsecode'] == 00)
        {

            $product['user_id'] = Auth::id();
            $product['firstName'] = $rep['firstName'];
            $product['lastName'] =  $rep['lastName'];
            $product['phoneNumber'] =  $rep['phoneNumber'];
            $product['gender'] = $rep['data']['gender'];
            $product['dateOfBirth'] = $rep['data']['dateOfBirth'];
            $product['base64Image'] = $rep['base64Image'];
            $product['number'] = $request->bvn;
            Verified::create($product);

            $user->bvn_verify = 1;
            $user->bvn_time = Carbon::now();
            $user->balance = $user->balance - $basic->bvn;
            $user->save();

            return response()->json(['status' => 1, 'message' => 'Bank Verification Number has been verfied successfully']);

        } else {
            return response()->json(['status' => 0, 'message' => 'You Have Entered A Wrong Bank Verification Number']);
        }
    }
}
