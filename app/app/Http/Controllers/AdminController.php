<?php

namespace App\Http\Controllers;

use App\Admin;
use App\BuyMoney;
use App\ExchangeMoney;
use App\Provider;
use App\SellMoney;
use App\Message;
use App\Transaction;
use App\Trx;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use App\GeneralSettings;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use File;
use Image;
class AdminController extends Controller
{

	public function __construct(){
		$Gset = GeneralSettings::first();
		$this->sitename = $Gset->sitename;
		$this->middleware('auth:admin');
	}

    public function createadmin()
    {

        if(Auth::guard('admin')->user()->role != 0 ){
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
        $data['page_title'] = 'Create Admin';
        return view('admin.subadmin.create', $data);
	}

	 public function  createadminpost(Request $request)
    {

                    Admin::create([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'password' => $request->password,
                    'role' => $request->role,

                ]);

        $notification = array('success' => 'New Administrative Staff Created Successfuly!', 'alert-type' => 'success');
        return back()->with($notification);
    }


    public function manageadmin()
    {

        if(Auth::guard('admin')->user()->role != 0 ){
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
        $data['page_title'] = 'Create Admin';
        $data['admin'] = Admin::where('id', '!=', 1)->get();
        return view('admin.subadmin.list', $data);
	}
    public function blockadmin($id)
    {

        if(Auth::guard('admin')->user()->role != 0 ){
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
        $admin = Admin::whereId($id)->first();
        $admin->status = 0;
        $admin->save();
        $notification = array('success' => 'Admin Blocked Successfuly!', 'alert-type' => 'success');
         return back()->with($notification);
	}

    public function activateadmin($id)
    {

        if(Auth::guard('admin')->user()->role != 0 ){
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
        $admin = Admin::whereId($id)->first();
        $admin->status = 1;
        $admin->save();
        $notification = array('success' => 'Admin Activated Successfuly!', 'alert-type' => 'success');
         return back()->with($notification);
	}


    public function viewadmin($id)
    {

        if(Auth::guard('admin')->user()->role != 0 ){
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
        $data['page_title'] = 'View Admin';
        $data['user'] = Admin::whereId($id)->first();
        return view('admin.subadmin.view', $data);
	}


    public function updateadmin(Request $request)
    {

        if(Auth::guard('admin')->user()->role != 0 ){
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
        $admin = Admin::whereId($request->id)->first();
        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        $admin->role = $request->role;
        if($request->password){
        $admin->password = bcrypt($request->password);
        }
        $admin->save();

        $notification = array('success' => 'Admin Updated Successfuly!', 'alert-type' => 'success');
         return back()->with($notification);
	}


    public function deleteadmin($id)
    {

        if(Auth::guard('admin')->user()->role != 0 ){
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
        $admin = Admin::whereId($id)->first();
       $admin->delete();

        $notification = array('success' => 'Admin Deleted Successfuly!', 'alert-type' => 'success');
         return back()->with($notification);
	}



    public function exchangeLog()
    {
        $data['exchange'] = ExchangeMoney::where('status', '!=',0)->latest()->get();
        $data['page_title'] = 'Manage Exchange Log';
        return view('admin.currency.exchange-list', $data);
	}

    public function exchangeInfo($id)
    {
        $get = ExchangeMoney::where('id',$id)->where('status','!=',0)->first();
        if($get)
        {
            $data['exchange'] = $get;
            $data['page_title'] = ' Exchange Log Details';
            return view('admin.currency.exchange-info', $data);
        }
        abort(404);
	}

    public function exchangeapprove($id)
    {
        $data = ExchangeMoney::find($id);
        $data->status= 2;
        $data->save();


        Message::create([
                    'user_id' => $data->user_id,
                    'title' => 'Exchange Approved',
                    'details' => 'Your cryptocurrency exchange with transaction number '.$data->transaction_number.' was approved. Your fund has been credited into your wallet as requested',
                    'admin' => 1,
                    'status' =>  0
                ]);



        $notification =  array('message' => 'Exchange Approved Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
	}

	   public function tvLog()
    {
        $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){

        $data['trx'] = Transaction::whereType(3)->latest()->get();
        $data['page_title'] = 'Cable TV Transactions';
        return view('admin.products.tv', $data);
        }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }

    }

	   public function airtimerecharge()
    {
         $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){

        $data['trx'] = Transaction::whereType(1)->latest()->get();
        $data['page_title'] = 'Airtime Recharge';
        return view('admin.products.airtime', $data);
        }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
    }
	   public function internetsub()
    {
         $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){

        $data['trx'] = Transaction::whereType(2)->latest()->get();
        $data['page_title'] = 'Internet Subscription';
        return view('admin.products.internet', $data);
    }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
    }
	   public function powerpaid()
    {
         $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){

        $data['trx'] = Transaction::whereType(4)->latest()->get();
        $data['page_title'] = 'Utility Bills Payment';
        return view('admin.products.power', $data);
        }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
    }

	   public function banktransfers()
    {
         $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){

        $data['trx'] = Transaction::whereType(5)->latest()->get();
        $data['page_title'] = 'Bank Transfers';
        return view('admin.products.banktrans', $data);
    }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
    }


    public function banktransferapprove($id)
    {
         $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){
        $data = Transaction::find($id);
        $data->status= 1;
        $data->save();


         Message::create([
                    'user_id' => $data->user_id,
                    'title' => 'Bank Transfer Approved',
                    'details' => 'Your other bank transfer with transaction number '.$data->trx.' was approved',
                    'admin' => 1,
                    'status' =>  0
                ]);



        $notification =  array('message' => 'Transaction Approved Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);

    }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
	}



    public function banktransferreject($id)
    {
         $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){

        $data = Transaction::find($id);
        $data->status= 2;
        $data->save();

        $user = User::find($data->user_id);
        $user->balance = $user->balance + $data->amount;
        $user->save();


         Message::create([
                    'user_id' => $data->user_id,
                    'title' => 'Bank Transfer Rejected',
                    'details' => 'Your other bank transfer with transaction number '.$data->trx.' was rejected',
                    'admin' => 1,
                    'status' =>  0
                ]);



        $notification =  array('message' => 'Transaction Rejected Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
        }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
	}


    public function exchangereject($id)
    {
         $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){
        $data = ExchangeMoney::find($id);
        $data->status= -2;
        $data->save();


         Message::create([
                    'user_id' => $data->user_id,
                    'title' => 'Exchange Rejected',
                    'details' => 'Your cryptocurrency exchange was with transaction number '.$data->transaction_number.' rejected. Please send us a message to facilitate a refund if your money is not refunded in 24hours',
                    'admin' => 1,
                    'status' =>  0
                ]);



        $notification =  array('message' => 'Exhange Rejected Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
    }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
	}

    public function buyLog()
    {
         $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){
        $data['exchange'] = Trx::whereStatus(2)->whereType(1)->latest()->get();
        $data['page_title'] = 'Processed Purchase';
        return view('admin.currency.buy-list', $data);
        }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
    }
    public function pendingbuyLog()
    {
         $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){

        $data['exchange'] = Trx::whereStatus(1)->whereType(1)->latest()->get();
        $data['page_title'] = 'Pending Purchase';
        return view('admin.currency.buy-list', $data);
    }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
    }
    public function declinedbuyLog()
    {
         $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){

        $data['exchange'] = Trx::whereStatus(-2)->whereType(1)->latest()->get();
        $data['page_title'] = 'Declined Purchase';
        return view('admin.currency.buy-list', $data);
        }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
    }

    public function buyInfo($id)
    {
         $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){
        $get = Trx::where('id',$id)->where('status','!=',0)->first();
        if($get)
        {
            $data['exchange'] = $get;
            $data['page_title'] = ' Buy Log Details';
            return view('admin.currency.buy-info', $data);
        }
        abort(404);
    }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
    }

    public function peeruser(Request $request, $id)
    {
          $request->validate([
            'bank_name' => 'required',
            'account_name' => 'required|min:10',
            'account_number' => 'required',
        ]);


         $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){

        $data = Trx::find($id);

        if($data->action == 1){
             $notification = array('danger' => 'You have already paired this buy order with a bank account details!', 'alert-type' => 'danger');

        }
        $basic = GeneralSettings::first();
        $data->action= 1;
        $data->bankname= $request->bank_name;
        $data->accountname= $request->account_name;
        $data->accountnumber= $request->account_number;

        $data->save();
        Message::create([
                    'user_id' => $data->user_id,
                    'title' => 'You Have Been Paired',
                    'details' => 'Your cryptocurrency sell order with transaction number '.$data->trx.' has been processed. You have been paired to make payment to the following account details. Please note you have a 15Minutes payment window to complete the transaction before payment is closed on our server. Click the link below continue process <a href="'.$basic->baseurl.'/user/pair-pay/'.$data->trx.'"<button class="btn btn-success">Proceed</button></a>',
                    'admin' => 1,
                    'status' =>  0
                ]);



        $notification =  array('message' => 'User Paired Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
        }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
    }

    public function buyapprove($id)
    {
         $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){

        $data = Trx::find($id);
        $basic = GeneralSettings::first();
              $data->status= 2;
              $data->timeout= Carbon::now()->addMinutes(15);

        $data->save();
         Message::create([
                    'user_id' => $data->user_id,
                    'title' => 'Coin Purchase Approved',
                    'details' => 'Your cryptocurrency purchase with transaction number '.$data->trx.'  was approved. Your account has been credited as required, Thank you for choosing '.$basic->sitename.'',
                    'admin' => 1,
                    'status' =>  0
                ]);



        $notification =  array('message' => 'Approved Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
        }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
    }

    public function buyreject(Request $request)
    {
        $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){
        $data = Trx::find($request->id);
        $basic = GeneralSettings::first();
        $user = User::findOrFail($data->user_id);



                      Message::create([
                    'user_id' => $data->user_id,
                    'title' => 'Purchase Rejected',
                    'details' => 'Your cryptocurrency purchase with transaction number '.$data->trx.' was rejected. Please send us a message for complaints or clarifications on purchase rejection',
                    'admin' => 1,
                    'status' =>  0
                ]);

                $msg =  ' Buy Declined ' . $data->main_amo . ' ' . $basic->currency;
                send_email($user->email, $user->username, 'Buy Amount return ', $msg);

                 $data->status= -2;

                  $data->save();

        $notification =  array('message' => 'Cryptocurrency Purchase Was Rejected Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
    }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
    }

    public function sellLog()
    {
        $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){

        $data['exchange'] = Trx::whereStatus(2)->whereType(2)->latest()->get();
        $data['page_title'] = 'Processed Sales';
        return view('admin.currency.sell-list', $data);

        }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
    }
    public function pendingsellLog()
    {
          $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){
        $data['exchange'] = Trx::whereStatus(1)->whereType(2)->latest()->get();
        $data['page_title'] = 'Pending Sales';
        return view('admin.currency.sell-list', $data);
    }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
    }
    public function declinedsellLog()
    {
          $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){
        $data['exchange'] = Trx::whereStatus(-2)->whereType(2)->latest()->get();
        $data['page_title'] = 'Declined Sales';
        return view('admin.currency.sell-list', $data);
        }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
    }
    public function sellInfo($id)
    {
         $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){
        $get = Trx::where('id',$id)->where('status','!=',0)->first();
        if($get)
        {
            $data['exchange'] = $get;
            $data['page_title'] = ' Sell Log Details';
            return view('admin.currency.sell-info', $data);
        }
        abort(404);
    }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
    }

    public function sellapprove($id)
    {
         $role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){
        $data = Trx::whereId($id)->whereStatus(1)->first();
        $basic = GeneralSettings::first();
        $data->status= 2;

                     Message::create([
                    'user_id' => $data->user_id,
                    'title' => 'Sales Approved',
                    'details' => 'Your cryptocurrency sales with transaction number '.$data->trx.' has been approved. You fund has been credited to your account as required. Thank you for choosing us',
                    'admin' => 1,
                    'status' =>  0
                ]);

                $user = User::find($data->user_id);
                 $user->balance = $user->balance + $data->main_amo;
                 $user->save();
                $msg =  ' Sell Amount  ' . $data->get_amount . ' ' . $basic->currency;
                send_email($user->email, $user->username, 'Sell Amount  ', $msg);

        $data->save();

        $notification =  array('message' => 'Crypto Sales Approved Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
        }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
    }


 public function sellreject($id)
    {

$role = Auth::guard('admin')->user();
        if($role->role == 0 || $role->role == 1 ){
        $data = Trx::find($id);
        $basic = GeneralSettings::first();

                     Message::create([
                    'user_id' => $data->user_id,
                    'title' => 'Sale Rejected',
                    'details' => 'Your cryptocurrency sales was rejected. Please send us a message to facilitate a refund if your money is not refunded in 24hours',
                    'admin' => 1,
                    'status' =>  0
                ]);

           $data->status= -2;
          $data->save();

        $notification =  array('message' => 'Rejected Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
    }
        else{
             $notification = array('danger' => 'You dont have permission to view this page!', 'alert-type' => 'danger');
        return back()->with($notification);
        }
    }



	public function socialLogin()
    {
        $data['page_title'] = 'Manage Social Login';
        $data['providers'] = Provider::all();
        return view('admin.social-login.index', $data);
    }

    public function socialLoginUpd(Request $request)
    {
        $data =  Provider::find($request->id);
        $data->client_id =  $request->name;
        $data->client_secret =  $request->account;
        $data->save();

        $notification =  array('message' => 'Updated Successfully !!', 'alert-type' => 'success');
        return back()->with($notification);
    }


    public function dashboard()
    {
        $data['page_title'] = 'DashBoard';
        return view('admin.dashboard', $data);
    }

    public function dashnote()
    {
        $data['page_title'] = 'DashBoard Note';
        return view('admin.post.notifydash', $data);
    }


    public function changePassword()
    {
        $data['page_title'] = "Change Password";
        return view('admin.change_password',$data);
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:5',
            'password_confirmation' => 'required|same:new_password',
        ]);

        $user = Auth::guard('admin')->user();

        $oldPassword = $request->old_password;
        $password = $request->new_password;
        $passwordConf = $request->password_confirmation;

        if (!Hash::check($oldPassword, $user->password) || $password != $passwordConf) {
            $notification =  array('message' => 'Password Do not match !!', 'alert-type' => 'error');
            return back()->with($notification);
        }elseif (Hash::check($oldPassword, $user->password) && $password == $passwordConf)
        {
            $user->password = bcrypt($password);
            $user->save();
            $notification =  array('message' => 'Password Changed Successfully !!', 'alert-type' => 'success');
            return back()->with($notification);
        }
    }


    public function profile()
    {
        $data['admin'] = Auth::user();
        $data['page_title'] = "Profile Settings";
        return view('admin.profile',$data);
    }

    public function updateProfile(Request $request)
    {
        $data = Admin::find($request->id);
        $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|max:50|unique:admins,email,'.$data->id,
            'mobile' => 'required',
        ]);

        $in = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = 'admin_'.time().'.jpg';
            $location = 'assets/admin/img/' . $filename;
            Image::make($image)->resize(300,300)->save($location);
            $path = './assets/admin/img/';
            File::delete($path.$data->image);
            $in['image'] = $filename;
        }
        $data->fill($in)->save();

        $notification =  array('message' => 'Admin Profile Update Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }





    public function logout()    {
		Auth::guard('admin')->logout();
		session()->flash('message', 'Just Logged Out!');
		return redirect('/adminwantsomeicecubesbutitishardtoget');
	}

}
