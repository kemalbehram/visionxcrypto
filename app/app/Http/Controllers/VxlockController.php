<?php

namespace App\Http\Controllers;

use App\Bank;
use App\BuyMoney;
use App\Currency;
use App\Deposit;
use App\ExchangeMoney;
use App\PaymentMethod;
use App\Localbank;
use App\Gateway;
use App\GeneralSettings;
use App\SellMoney;
use App\Transaction;
use App\Trx;
use App\Faq;
use App\Verified;
use App\Verification;
use App\WithdrawLog;
use App\Banky;
use App\Message;
use App\Transfer;
use App\UserLogin;
use App\Post;
use App\Testimonial;
use App\WithdrawMethod;
use Illuminate\Http\Request;
use App\Cryptowallet;
use App\Lib\coinPayments;
use App\Lib\BlockIo;
use App\Lib\CoinPaymentHosted;
use Auth;
use Mail;
use App\User;
use App\Investyield;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Session;
use Image;
 
use App\Vxvault;
use App\Vxvaultwithdraw;

class VxlockController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

   
    
     public function vxlock()
    {
        $data['page_title'] = "VX Vault"; 
        return view('user.vxlock.vxlock', $data);
    }

    
     public function vxlockproceed(Request $request)
    {
        $data['page_title'] = "VX Vault"; 
        return redirect()->route('vxvault');
    }   
     public function vxvault(Request $request)
    {
        $data['page_title'] = "VX Vault"; 
        $data['vault'] = Vxvault::whereUser_id(Auth()->user()->id)->where('status','>', '0')->orderBy('id','desc')->get();
        $data['withdraw'] = Vxvaultwithdraw::whereUser_id(Auth()->user()->id)->orderBy('id','desc')->paginate(5);
        return view('user.vxlock.vxvault', $data);
    } 
     public function lockfund(Request $request)
    {
         $this->validate($request, [
            'amount' => 'required',
            'duration' => 'required',
        ]);
        
        $count =  Vxvault::whereUser_id(Auth()->user()->id)->whereStatus(1)->where('paid', '!=', 1)->count();
        if($count > 2){
             return back()->with("danger", "Sorry, you cant lock more than 3 assets at a time in your VX vault. Please wait till one or more of your assets expures");
        }
        $data['page_title'] = "VX Vault"; 
        $basic = GeneralSettings::first(); 
        $akey=$basic->bitcoin_address;
        $baseurl = "https://coinremitter.com/api/v3/BTC/create-invoice";
        $trx = rand(000000, 999999) . rand(000000, 999999);	
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $baseurl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('api_key' => $akey, 'password' => 'visionxcrypto', 'amount' => $request->amount, 'name' => $trx, 'currency' => 'USD', 'expire_time' => '15', 'suceess_url' => url("/api/sellcallback")),
            ));

            $response = curl_exec($curl);
            $reply = json_decode($response, true);
            curl_close($curl);
            //return $response;

            if(!isset($reply['data']['address'])){
                return back()->with('error','Amount too low');
            }
            $now = Carbon::now();
            $expire = Carbon::parse($now)->addMonth($request->duration); 

            $address = $reply['data']['address'];
            $invoiceid = $reply['data']['invoice_id'];
            $btcvalue = $reply['data']['total_amount']['BTC'];
            
            $lock['user_id'] = Auth::id();
            $lock['invoiceid'] = $invoiceid;
            $lock['amount'] = $request->amount*$basic->rate;
            $lock['status'] = 0;
            $lock['code'] = $trx;
            $lock['expire'] = $expire;
            $lock['usd'] = $request->amount;
            $lock['btc'] = $btcvalue;
            $lock['address'] = $address;
            
            $data = Vxvault::create($lock)->code;
    
            Session::put('Code', $lock['code']);
            return redirect()->route('previewvault');
    }
    
      public function previewvault()
    {
        $track = Session::get('Code');
        $data['data']  = Vxvault::where('status', 0)->where('code', $track)->first();
        $data['page_title'] = "VX Vault"; 
        return view('user.vxlock.vxvault-preview', $data);
    } 
    
     public function elockcallback(Request $request)
    {

        $basic = GeneralSettings::first();
        $data = Vxvault::where('status', 0)->where('code', $request->trx)->first();
        $auth = Auth::user();
        $data->save();

        
            $akey=$basic->bitcoin_address;
       
        $baseurl = "https://coinremitter.com/api/v3/BTC/get-invoice"; 
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseurl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('api_key' => $akey, 'password' => 'visionxcrypto', 'invoice_id' => $data->invoiceid),
        ));

        $response = curl_exec($curl);
        $reply = json_decode($response, true);
        curl_close($curl);

        if (!isset($reply['data']['status_code'])) {
            return back()->with("danger", "An error occur. Contact server admin");
        }
        //return $response;

        $status = $reply['data']['status_code'];

        if ($status == 0) {
            return back()->with("danger", "We have not received your payment. Kindly Scan and make payment");
        }
        if ($status == 4) {
            return back()->with("danger", "This transaction has expired. Please try again later ");
        }

        if ($data->status == 1) {
            return redirect()->route('vxlock')->with("danger", "Payment has been made already");
        }


        if ($status == 1 || $status == 3) {
            $basic = GeneralSettings::first();
            $data->status = 1;
            $data->save();
  
            Message::create([
                'user_id' => $data->user_id,
                'title' => 'Bitcoin Lock Successful',
                'details' => 'Your bitcoin lock with transaction number ' . $data->code . '  was successful. Your locked coin will be made available to you on the expiration of your lock tenure, Thank you for choosing ' . $basic->sitename . '',
                'admin' => 1,
                'status' => 0
            ]);

            return redirect()->route('vxlock')->with(['modal' => 'power', "success" => 'Your Bitcoin Lock with transaction number ' . $data->code . '  was successful.']);
        }

    }

  public function vxvaultwithdraw(Request $request)
    {
         $this->validate($request, [
            'wallet' => 'required',
            'confirm_wallet' => 'required',
            'password' => 'required',
        ]);
        
         if($request->wallet != $request->confirm_wallet){
            return back()->with("danger", "Sorry, Your confirm BTC Wallet Address is wrong. Please check and try again later");
         }  
        $auth = Auth::user();
        if($request->password != $auth->withdrawpass){
            $auth->withdrawpass_used += 1;
            $auth->save();
            
            if($auth->withdrawpass_used > 2){
            $auth->locked = 1;
             $auth->save();
            }
            return back()->with("danger", "Sorry, You have entered a wrong withdrawal password. You will be blocked for using wrong password 3 times");
        } 

        $basic = GeneralSettings::first();
        $data = Vxvault::where('status', 1)->where('code', $request->trx)->first();
        $auth = Auth::user();
        
         if(!$data){
            return back()->with("danger", "Sorry, there is no VX Vault with this transaction details. Please check and try again later");
        } 
        $data->save();
        
        if(Carbon::Now() < $data->expire){
            return back()->with("danger", "Your VX Vault is not mature enough for withdrawal. Please try again later");
        }   
        if($data->status > 1){
            return back()->with("danger", "You have already made withdrawal from this vault. Please create a new vault and come back later for withdrawal");
        } 
        
        if($data->status < 1){
            return back()->with("danger", "It seems you have not made any payment into your VX vault. Please check and try again later");
        }
        
        
          
        $akey=$basic->bitcoin_address;
       
        $baseurl = "https://coinremitter.com/api/v3/BTC/get-invoice"; 
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseurl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('api_key' => $akey, 'password' => 'visionxcrypto', 'invoice_id' => $data->invoiceid),
        ));

        $response = curl_exec($curl);
        $reply = json_decode($response, true);
        curl_close($curl);

        if (!isset($reply['data']['status_code'])) {
            return back()->with("danger", "An error occur. Contact server admin");
        }
        //return $response;

        $status = $reply['data']['status_code'];

        if ($status == 0) {
            return back()->with("danger", "We have not received your payment for this VX vault. Ensure you have made payment before you proceed with withdrawal");
        }
        if ($status == 4) {
            return back()->with("danger", "This VX vault transaction has expired on the blockchain network and it appeared you havent made any payment or locked any actual coin. Please contact admin for support or clarification.");
        }

        
        if ($status == 1 || $status == 3) {
            $basic = GeneralSettings::first();
            $data->status = 2;
            $data->save();
            
            if($auth->withdrawpass_used > 0){
            $auth->withdrawpass_used  = 0;
            $auth->save();
            }
             
            $withdraw['user_id'] = Auth::id();
            $withdraw['invoiceid'] = $data->invoiceid;
            $withdraw['address'] = $request->wallet;
            $withdraw['status'] = 0;
            $withdraw['code'] = $data->code;
            
            $dat = Vxvaultwithdraw::create($withdraw)->code;
  
            Message::create([
                'user_id' =>  Auth::id(),
                'title' => 'VX Vault Withdrawal Successful',
                'details' => 'Your bitcoin lock with transaction number ' . $data->code . '  has been successfully withdrawn from your vault. Please wait while we process your withdrawal, your fund will be available to you in less than 24hours Thank you for choosing ' . $basic->sitename . '',
                'admin' => 1,
                'status' => 0
            ]);

            return redirect()->route('vxvault')->with(['modal' => 'power', "success" => 'Your Bitcoin Lock with transaction number ' . $data->code . '  was successfully withdrawn.']);
        }

    }
    
    
      public function relockvault(Request $request)
    {
        $data = Vxvault::whereUser_id(Auth()->user()->id)->whereCode($request->trx)->orderBy('id','desc')->first();
        
        $now = Carbon::now();
        $expire = Carbon::parse($now)->addMonth($request->months); 
        $data->expire = $expire;
        $data->save();
        return back()->with("success", 'You have successfully relocked your vault with Vault Number '.$data->code.'. Your fund will be available for withdrawal in the next '.$request->months.' months');
    } 
    
      public function allvault()
    {
        $data['page_title'] = "Users' VX Vault"; 
        $data['vault'] = Vxvault::orderBy('id','desc')->get();
        $data['withdraw'] = Vxvaultwithdraw::orderBy('id','desc')->paginate(8);
        return view('admin.vxvault.vaults', $data);
    }

    
      public function unpaidvault()
    {
        $data['page_title'] = "Unprocessed VX Vault"; 
        $data['vault'] = Vxvault::orderBy('id','desc')->whereStatus(0)->paginate(8);
        return view('admin.vxvault.vaults', $data);
    }
      public function activevault()
    {
        $data['page_title'] = "Locked VX Vault"; 
        $data['vault'] = Vxvault::orderBy('id','desc')->whereStatus(1)->paginate(8);
        return view('admin.vxvault.vaults', $data);
    }
      public function closedvault()
    {
        $data['page_title'] = "Closed VX Vault"; 
        $data['vault'] = Vxvault::orderBy('id','desc')->whereStatus(3)->paginate(8);
        return view('admin.vxvault.vaults', $data);
    }
      public function pendingwithdraw()
    {
        $data['page_title'] = "Pending  Withdrawal"; 
        $data['vault'] = Vxvaultwithdraw::orderBy('id','desc')->whereStatus(0)->paginate(8);
        return view('admin.vxvault.vaults-withdraw', $data);
    }

      public function closedwithdraw()
    {
        $data['page_title'] = "Approved Withdrawal"; 
        $data['vault'] = Vxvaultwithdraw::orderBy('id','desc')->whereStatus(1)->paginate(8);
        return view('admin.vxvault.vaults-withdraw', $data);
    }
      public function declinedwithdraw()
    {
        $data['page_title'] = "Declined Withdrawal"; 
        $data['vault'] = Vxvaultwithdraw::orderBy('id','desc')->whereStatus(2)->paginate(8);
        return view('admin.vxvault.vaults-withdraw', $data);
    }
    
    
      public function viewvault($id)
    {
        $data['page_title'] = "View VX Vault"; 
        $data['vault'] = Vxvault::whereCode($id)->first();
        //$data['withdraw'] = Vxvaultwithdraw::whereCode($id)->first();
         $basic = GeneralSettings::first();
        
        $akey=$basic->bitcoin_address;
       
        $baseurl = "https://coinremitter.com/api/v3/BTC/get-invoice"; 
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseurl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('api_key' => $akey, 'password' => 'visionxcrypto', 'invoice_id' => $data['vault']->invoiceid),
        ));

        $response = curl_exec($curl);
        $reply = json_decode($response, true);
        curl_close($curl);
         if (!isset($reply['data']['status_code'])) {
           $data['api'] = 'An error occur fetching transaction. Contact server admin';
        }
        else{
            
        $data['api'] = $reply;
        }
        //return $reply;

        
        return view('admin.vxvault.viewvault', $data);
    }

      public function viewwithdraw($id)
    {
        $data['page_title'] = "View Withdrawal Request"; 
        $data['vault'] = Vxvault::whereCode($id)->first();
        $data['withdraw'] = Vxvaultwithdraw::whereCode($id)->first();
        $basic = GeneralSettings::first();
        $akey=$basic->bitcoin_address;
        $baseurl = "https://coinremitter.com/api/v3/BTC/get-invoice"; 
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseurl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('api_key' => $akey, 'password' => 'visionxcrypto', 'invoice_id' => $data['vault']->invoiceid),
        ));

        $response = curl_exec($curl);
        $reply = json_decode($response, true);
        curl_close($curl);
         if (!isset($reply['data']['status_code'])) {
           $data['api'] = 'An error occur fetching transaction. Contact server admin';
        }
        else{
            
        $data['api'] = $reply;
        }
        //return $reply;

        
        return view('admin.vxvault.viewwithdraw', $data);
    }
    
      public function approvewithdraw($id)
    {
        $data['page_title'] = "View VX Vault"; 
        $vault = Vxvault::whereCode($id)->first();
        $withdraw = Vxvaultwithdraw::whereCode($id)->first();
        
        $withdraw->status = 1;
        $withdraw->save();
        
        $vault->status = 3;
        $vault->paid = 1;
        $vault->save();
        
         $basic = GeneralSettings::first();
           Message::create([
                'user_id' =>  Auth::id(),
                'title' => 'VX Vault Withdrawal Approved',
                'details' => 'Your bitcoin lock withdrawal request with transaction number ' . $vault->code . '  has been approved and fund has been disbursed into your bitcoin walled address as requested. . Thank you for choosing ' . $basic->sitename . '',
                'admin' => 1,
                'status' => 0
            ]);
        
         return back()->with("success", "Withdrawal has been approved and vault has been closed");
    
    }

   public function rejectwithdraw($id)
    {
        $data['page_title'] = "View VX Vault"; 
        $vault = Vxvault::whereCode($id)->first();
        $withdraw = Vxvaultwithdraw::whereCode($id)->first();
        
        $withdraw->status = 2;
        $withdraw->save();
        
        $vault->status = 4;
        $vault->save();
         $basic = GeneralSettings::first();
           Message::create([
                'user_id' =>  Auth::id(),
                'title' => 'VX Vault Withdrawal Rejected',
                'details' => 'Your bitcoin lock withdrawal request with transaction number ' . $vault->code . '  has been rejected . Thank you for choosing ' . $basic->sitename . '',
                'admin' => 1,
                'status' => 0
            ]);
        
         return back()->with("success", "Withdrawal has been rejected and vault has been closed");
    
    }





}
