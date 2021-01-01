<?php

namespace App\Http\Controllers\Api;

use App\GeneralSettings;
use App\Transaction;
use App\User;
use App\VirtualCard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HistoryController extends Controller
{

    public function showVXCs(){
        $cards=VirtualCard::where('user_id', Auth::id())->get();

        return response()->json(['status' => 1, 'message' => 'Cards fetched successfully', 'data'=>$cards]);
    }

    public function transactionsVXC($id){

        $card=VirtualCard::find($id);
        $basic = GeneralSettings::first();

        if(!$card){
            return response()->json(['status' => 0, 'message' => 'Card does not exist']);
        }

        if($card->user_id != Auth::id()){
            return response()->json(['status' => 0, 'message' => 'Card does not exist']);
        }

        if($card->status == "terminated"){
            return response()->json(['status' => 0, 'message' => 'Card already terminated']);
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $basic->	flutterwave_url."/virtual-cards/".$card->card_id."/transactions?from=2019-01-01&to=".Carbon::now()->format('Y-m-d')."&index=0&size=5",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $basic->flutterwave_seckey"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $res=json_decode($response, true);

        if($res['status']=="success") {
            if($res['data']=="[]") {
                return response()->json(['status' => 1, 'message' => 'Card transactions fetched successfully', 'data' => $res['data']]);
            }else{
                return response()->json(['status' => 0, 'message' => $res['message']]);
            }
        }else{
            return response()->json(['status' => 0, 'message' => $res['message']]);
        }

    }

    public function showNotifications(){
        $user=User::find(Auth::id());
        $noti=$user->notifications;

        return response()->json(['status' => 1, 'message' => 'Notifications fetched successfully', 'data'=>$noti]);
    }

}
