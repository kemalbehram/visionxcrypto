<?php

namespace App\Http\Controllers\Api;

use App\GeneralSettings;
use App\Http\Controllers\Controller;
use App\Power;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ValidateController extends Controller
{
    public function validatetv(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'decodertype' => 'required',
            'decodernumber' => 'required',
//
        ], [
            'decodertype.required' => 'Please select a decoder type',
            'decodernumber.required' => 'Please enter a decoder number',
        ]);

        if ($request->decodertype == "DSTV") {
            $decodertype = "01";
        } elseif ($request->decodertype == "GOTV") {
            $decodertype = "02";
        } else {
            $decodertype = "03";
        }

        $basic = GeneralSettings::first();
        $baseUrl = "https://www.nellobytesystems.com";
        $endpoint = "/APIVerifyCableTVV1.0.asp?UserID=" . $basic->clubkonnect_id . "&APIKey=" . $basic->clubkonnect_key . "&cabletv=" . $decodertype . "&smartcardno=" . $request->decodernumber . "";

        $url = $baseUrl . $endpoint;
        // Perform initialize to validate name on server
        $result = file_get_contents($url);

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
        $errmsg = curl_error($ch);
        curl_close($ch);
        $result = implode(', ', (array)$content);

        if ($result == "") {
            return response()->json(['status' => 0, 'message' => 'Error validating decoder number. Please Try Again']);
        }

        return response()->json(['status' => 1, 'message' => 'Validated Successfully', 'name' => $result, 'charges'=>$basic->decoderfee*1]);
    }

    public function validatemeter(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'meternumber' => 'required',
            'name' => 'required',
            'type' => 'required',

        ], [
            'code.required' => 'Please select your meter type',
            'meternumber.required' => 'Please enter a meter number',
        ]);

        $cp = Power::where([['name', '=', $request->name]])->first();

        $basic = GeneralSettings::first();

        $baseUrl = "https://www.nellobytesystems.com";
        $endpoint = "/APIVerifyElectricityV1.asp?UserID=".$basic->clubkonnect_id."&APIKey=".$basic->clubkonnect_key."&ElectricCompany=".$cp->code."&MeterNo=".$request->meternumber;

        $url=$baseUrl.$endpoint;
        // Perform initialize to validate name on server
        $result = file_get_contents($url);
        $rep=json_decode($result, true);

        if ($rep['customer_name']=="INVALID_METERNO" || $rep['customer_name']=="Service unavailable. Please try again later.") {
            return response()->json(['status' => 0, 'message' => 'it seems you have entered a wrong meter number or you have selected a wrong meter. Please check and try again']);
        }else{
            return response()->json(['status' => 1, 'message' => 'Validated successfully', 'data' => $rep['customer_name'], 'code' => $cp->code, 'charges'=>$basic->electricityfee*1]);
        }

    }

    public function validatebank(Request $request)
    {
        $user = Auth::user();
        $basic = GeneralSettings::first();

        $input = $request->all();
        $rules = array(
            'bankcode' => 'required',
            'accountno' => 'required',
        );

        $messages=[
            'bank.required' => 'Please select bank name',
            'amount.required' => 'Please enter amount to transfer',
            'accountno.required' => 'Please enter account number',
        ];

        $validator = Validator::make($input, $rules, $messages);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $basic = GeneralSettings::first();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number=".$request->accountno."&bank_code=".$request->bankcode,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: ".$basic->paystack_secret,
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $rep=json_decode($response, true);

        $basic = GeneralSettings::first();

        if($rep['status'])
        {
            return response()->json(['status' => 1, 'message' => 'Account validated successfully', 'name'=>$rep['data']['account_name'], 'charges'=>$basic->transcharge*1]);
        }
        else{
            return response()->json(['status' => 0, 'message' => 'Sorry, Account Number Not Valid.']);
        }

    }

    public function validateuser(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'accountid' => 'required',
        );

        $messages=[
            'accountid.required' => 'Please enter valid account identifier',
        ];

        $validator = Validator::make($input, $rules, $messages);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $r=User::where('account_number', '=', $request->accountid)->first();

        if($r){
            return response()->json(['status' => 1, 'message' => 'Account validated successfully', 'name'=>$r->fname . " ". $r->lname, 'accountno'=>$r->account_number, 'image'=>$r->image]);
        }

        $r=User::where('phone', '=', $request->accountid)->first();

        if($r){
            return response()->json(['status' => 1, 'message' => 'Account validated successfully', 'name'=>$r->fname . " ". $r->lname, 'accountno'=>$r->account_number, 'image'=>$r->image]);
        }

        $r=User::where('username', '=', $request->accountid)->first();

        if($r){
            return response()->json(['status' => 1, 'message' => 'Account validated successfully', 'name'=>$r->fname . " ". $r->lname, 'accountno'=>$r->account_number, 'image'=>$r->image]);
        }

        return response()->json(['status' => 0, 'message' => 'Sorry, Account Number Not Valid.']);

    }
}
