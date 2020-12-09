<?php

namespace App\Http\Controllers\Api;

use App\GeneralSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

        $basic = GeneralSettings::first();
        $baseUrl = "https://www.nellobytesystems.com";
        $endpoint = "/APIVerifyCableTVV1.0.asp?UserID=".$basic->clubkonnect_id."&APIKey=".$basic->clubkonnect_key."&cabletv=".$request->decodertype."&smartcardno=".$request->decodernumber."";

        $url=$baseUrl.$endpoint;
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
        $errmsg  = curl_error( $ch );
        curl_close($ch);
        $result = implode(', ', (array)$content);

        if ($result == ""){
            return response()->json(['status' => 0, 'message' => 'Error validating decoder number. Please Try Again']);
        }

        return response()->json(['status' => 1, 'message' => 'Validated Successfully', 'name'=>$result]);
    }
}
