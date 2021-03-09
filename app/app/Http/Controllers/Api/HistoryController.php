<?php

namespace App\Http\Controllers\Api;

use App\GeneralSettings;
use App\Http\Controllers\Controller;
use App\Invest;
use App\Message;
use App\Transaction;
use App\VirtualCard;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{

    public function invoicel5(){
        $trans=Transaction::where('user_id', Auth::id())->orderBy('id', 'desc')->limit(5)->get();

        $spent=Transaction::where('user_id', Auth::id())->sum('amount');


        return response()->json(['status' => 1, 'message' => 'Transactions fetched successfully', 'spent'=>$spent, 'balance'=>round(Auth::user()->balance), 'trans'=>$trans]);
    }

    public function invoice(){
        $trans=Transaction::where('user_id', Auth::id())->orderBy('id', 'desc')->get();

        $spent=Transaction::where('user_id', Auth::id())->sum('amount');


        return response()->json(['status' => 1, 'message' => 'Transactions fetched successfully', 'spent'=>$spent, 'balance'=>Auth::user()->balance, 'trans'=>$trans]);
    }

    public function invoicemy($month, $year){
        $trans=Transaction::where([['user_id', Auth::id()], ['created_at', 'LIKE', "%".$year."-".$month."%"] ])->orderBy('id', 'desc')->get();

        $spent=Transaction::where('user_id', Auth::id())->sum('amount');

        if($trans->isEmpty()){
            return response()->json(['status' => 0, 'message' => 'Transactions not found', 'spent'=>$spent, 'balance'=>Auth::user()->balance]);
        }

        return response()->json(['status' => 1, 'message' => 'Transactions fetched successfully', 'spent'=>$spent, 'balance'=>Auth::user()->balance, 'trans'=>$trans]);
    }

    public function showVXCs(){
        $cards=VirtualCard::where('user_id', Auth::id())->get();

        if($cards->isEmpty()){
            return response()->json(['status' => 0, 'message' => 'No virtual cards found']);
        }

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
            if($res['data']!="[]") {
                return response()->json(['status' => 1, 'message' => 'Card transactions fetched successfully', 'data' => $res['data']]);
            }else{
                return response()->json(['status' => 0, 'message' => $res['message']]);
            }
        }else{
            return response()->json(['status' => 0, 'message' => $res['message']]);
        }

    }

    public function getVXC($id){

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
            CURLOPT_URL => $basic->	flutterwave_url."/virtual-cards/".$card->card_id,
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
            return response()->json(['status' => 1, 'message' => 'Card details fetched successfully', 'amount' => $res['data']['amount'], 'currency' => $res['data']['currency']]);
        }else{
            return response()->json(['status' => 0, 'message' => $res['message']]);
        }

    }

    public function showNotifications(){
        $noti=Message::where('user_id', Auth::id())->orderBy('id', 'desc')->get();

        if($noti->isEmpty()){
            return response()->json(['status' => 0, 'message' => 'No Notifications yet']);
        }

        return response()->json(['status' => 1, 'message' => 'Notifications fetched successfully', 'data' => $noti]);
    }

    public function investmentdetails($id)
    {
        $invest = Invest::where([['user_id', Auth::id()], ['plan_id', $id], ['status', 1]])->orderBy('id', 'desc')->first();

        if ($invest) {
            return response()->json(['status' => 1, 'message' => 'Investment fetched successfully', 'data' => $invest]);
        } else {
            return response()->json(['status' => 0, 'message' => 'No Investment']);
        }
    }

    public function transfers()
    {
        $trans = Transaction::where([['user_id', Auth::id()], ['gateway', 'LIKE', '%Transfer%']])->orderBy('id', 'desc')->get();

        if ($trans->isEmpty()) {
            return response()->json(['status' => 0, 'message' => 'No transfers found']);
        } else {
            return response()->json(['status' => 1, 'message' => 'Transfers fetched successfully', 'data' => $trans]);
        }
    }

}
