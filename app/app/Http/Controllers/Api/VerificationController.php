<?php

namespace App\Http\Controllers\Api;

use App\GeneralSettings;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use App\Verification;
use App\Verified;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VerificationController extends Controller
{
    public function vstatus()
    {
        $level2a = Auth::user()->bvn_verify;
        $level2aa = Auth::user()->bvnyes;
        $level2b = Auth::user()->verified;

        $level3a = Verification::where([['user_id', Auth::id()], ['type', 'Proof of Bank History']])->exist();
        $level3b = Verification::where([['user_id', Auth::id()], ['type', 'Proof of Address']])->exist();

        return response()->json(['status' => 1, 'message' => 'Verifications fetched successfully', 'level2a' => $level2a, 'level2b' => $level2b, 'level3a' => $level3a, 'level3b' => $level3b]);
    }

    public function verification2a(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'bvn' => 'required',
            'bank_code' => 'required',
            'accountno' => 'required',
            'bank_name' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }


        $basic = GeneralSettings::first();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://openapi.rubiesbank.io/v1/nameenquiry",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\n\t\t\"accountnumber\":\"$request->accountno\",\n\t\t\"bankcode\":\"$request->bank_code\"\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: ".$basic->rubies_secretkey,
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $rep=json_decode($response, true);

            if($rep['responsecode'] == 00) {
                $user=Auth::user();
                $acctname = $rep['accountname'];

                $user->bank = $request->bank_name;
                $user->accountname = $acctname;
                $user->bankyes = 1;
                $user->accountno = $request->accountno;
                $user->bankcode = $request->bank_code;
                $user->save();
            }else{
                return response()->json(['status' => 0, 'message' => 'Bank Verification error']);
            }

        $basic = GeneralSettings::first();
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
            $user->fname = $rep['firstName'];
            $user->lname = $rep['lastName'];
            $user->gender = $rep['data']['gender'];
            $user->dob = $rep['data']['dateOfBirth'];
            $user->save();

            return response()->json(['status' => 1, 'message' => 'Verification successful']);

        } else {
            return response()->json(['status' => 0, 'message' => 'You Have Entered A Wrong Bank Verification Number']);
        }
    }

    public function verification2b(Request $request)
    {

        $input = $request->all();
        $rules = array(
            'type' => 'required',
            'image1' => 'required',
            'image2' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $docm['user_id'] = Auth::id();
        $docm['type'] = $request->type;
        $docm['date'] = Carbon::now();
        $docm['number'] = " ";
        $docm['status'] = 0;

        if($input['image1']) {
            $docm['image1'] = uniqid().'.jpg';
            $file_data = $input['image1'];
            //generating unique file name;
            $file_name = $docm['image1'];
            @list($type, $file_data) = explode(';', $file_data);
            @list(, $file_data) = explode(',', $file_data);
            if ($file_data != "") {
                // storing image in storage/app/public Folder
//                \Storage::disk('public')->put($file_name, base64_decode($file_data));
                \File::put(storage_path(). '../../kyc/' . $file_name, base64_decode($file_data));

                //Storage::put('/' . $file_name, $file_data, 'public');
            }
        }


        if($input['image2']) {
            $docm['image2'] = uniqid().'.jpg';
            $file_data = $input['image2'];
            //generating unique file name;
            $file_name = $docm['image2'];
            @list($type, $file_data) = explode(';', $file_data);
            @list(, $file_data) = explode(',', $file_data);
            if ($file_data != "") {
                // storing image in storage/app/public Folder
//                \Storage::disk('public')->put($file_name, base64_decode($file_data));
                 \File::put(storage_path(). '../../kyc/' . $file_name, base64_decode($file_data));

                //Storage::put('/' . $file_name, $file_data, 'public');
            }
        }

        Verification::create($docm);

        $user = User::find(Auth::id());
        $user['verified'] = 1 ;
        $user->save();


        Message::create([
            'user_id' => $user->id,
            'title' => 'KYC Submited',
            'details' =>'Your KYC submission has been received. Please wait while we verify your submissin. You will receive a message once your submission has been approved',
            'admin' => 1,
            'status' =>  0
        ]);

        return response()->json(['status' => 1, 'message' => 'Verification submitted successfully']);

    }


    public function verification3ab(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'type' => 'required',
            'image' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $docm['user_id'] = Auth::id();
        $docm['type'] = $request->type;
        $docm['date'] = Carbon::now();
        $docm['status'] = 0;

        if($input['image']) {
            $docm['image'] = uniqid().'.jpg';
            $file_data = $input['image'];
            //generating unique file name;
            $file_name = $docm['image'];
            @list($type, $file_data) = explode(';', $file_data);
            @list(, $file_data) = explode(',', $file_data);
            if ($file_data != "") {
                // storing image in storage/app/public Folder
//                \Storage::disk('public')->put($file_name, base64_decode($file_data));
                \File::put(storage_path(). '../../kyc/' . $file_name, base64_decode($file_data));

                //Storage::put('/' . $file_name, $file_data, 'public');
            }
        }

        Verification::create($docm);

        $user = User::find(Auth::id());
        $user['verified'] = 1 ;
        $user->save();


        Message::create([
            'user_id' => $user->id,
            'title' => 'KYC Submited',
            'details' =>'Your KYC submission has been received. Please wait while we verify your submission. You will receive a message once your submission has been approved',
            'admin' => 1,
            'status' =>  0
        ]);

        return response()->json(['status' => 1, 'message' => 'Verification submitted successfully']);

    }

}
