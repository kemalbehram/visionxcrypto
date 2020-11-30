<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Plan;
use App\Invest;
use App\TimeSetting;
use Illuminate\Http\Request;

use App\GeneralSettings;
class PlanController extends Controller
{
	
	public function __construct(){
		$Gset = GeneralSettings::first();
		$this->sitename = $Gset->sitename;
		$this->middleware('auth:admin');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	 
	 
    public function userslan()
    {
        $page_title = "Users Investment Plan";
        $plan = invest::latest()->paginate(6);
        return view('admin.plan.usersplan', compact('page_title', 'plan'));
    }
	 public function pendingplan()
    {
        $page_title = "Users Investment Plan";
        $plan = invest::where('status','=', 2)->paginate(6);
        return view('admin.plan.pendingplan', compact('page_title', 'plan'));
    }
	
	
    public function investapprove($id)
    {
        $page_title = "Users Investment Plan";
        $plan = invest::where('id','=', $id)->first(); 
		$plan->status = 1;
		$plan->save();
		  $notification =  array('success' => 'Investment plan approved successfully', 'alert-type' => 'success');
        return back()->with($notification); 
    }
    public function investreject($id)
    {
        $page_title = "Users Investment Plan";
        $plan = invest::where('id','=', $id)->first(); 
		$plan->status = 17;
		$plan->save();
		  $notification =  array('success' => 'Investment plan rejected successfully', 'alert-type' => 'success');
        return back()->with($notification); 
    }   
	public function investdelete($id)
    {
        $page_title = "Users Investment Plan";
        $plan = invest::where('id','=', $id)->first(); 
		$plan->delete();
		  $notification =  array('success' => 'Investment plan deleted successfully', 'alert-type' => 'success');
        return back()->with($notification); 
    }
	 public function investview ($id)
    {
        $page_title = "Users Investment Plan";
        $invest = invest::where('id','=', $id)->first(); 
        $plan = Plan::where('id','=', $invest->plan_id)->first(); 
		return view('admin.plan.pendingplanview', compact('page_title', 'plan','invest'));
    }


	 
	 
	 
	 
    public function index()
    {
        $page_title = "Manage Plan";
        $plan = Plan::latest()->get();
        return view('admin.plan.index', compact('page_title', 'plan'));
    }
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Create New Plan";
        $time = TimeSetting::all();

        return view('admin.plan.create', compact('page_title','time'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'times' => 'numeric|min:0',
            'interest' => 'numeric|min:0',
        ]);

        if ($request->amount_type == 'on'){
            $fixed_amount = $request->amount;
            $minimum = $request->amount;
            $maximum= $request->amount;
        }else{
            $fixed_amount = 0;
            $minimum = $request->minimum;
            $maximum= $request->maximum;
        }

        $interrest_status =  ($request->interest_status == '%') ? 1 : 0;

        if ($request->lifetime_status == 'on'){
            $lifetime_status = 0;
            $repeat_time = $request->repeat_time;
        }else{
            $lifetime_status = 1;
            $repeat_time = 0;
        }

        if ($request->capital_back_status == 'on'){
            $capital_back_status = ($lifetime_status == 1) ? 0 : 1;
        }else{
            $capital_back_status = 0;
        }

        if ($minimum < 0 or $maximum < 0 or $fixed_amount < 0){
           $notification =  array('danger' => 'Invest Amount cannot be lower than 0', 'alert-type' => 'danger');
        return back()->with($notification); 
        }

        if ($request->interest < 0){
           $notification =  array('danger' => 'Interest Amount cannot be lower than 0', 'alert-type' => 'danger');
        return back()->with($notification); 
        }

        if ($repeat_time < 0){
            $notification =  array('danger' => 'Return time cannot be lower than 0', 'alert-type' => 'danger');
        return back()->with($notification); 
        }

        Plan::create([
            'name' => $request->name,
            'minimum' => $minimum,
            'maximum' => $maximum,
            'fixed_amount' => $fixed_amount,
            'interest' => $request->interest,
            'interest_status' => $interrest_status,
            'times' => $request->times,
            'status' => 1,
            'capital_back_status' => $capital_back_status,
            'lifetime_status' => $lifetime_status,
            'repeat_time' => $repeat_time,
            'status' => ($request->status == 'on') ? 1 : 0,
            'featured' => ($request->featured == 'on') ? 1 : 0
        ]);

         $notification =  array('success' => 'Investment plan created successfully', 'alert-type' => 'success');
        return back()->with($notification); 

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = "Update Plan";
        $time = TimeSetting::all();
        $plan = Plan::whereId($id)->first();
        return view('admin.plan.edit', compact('page_title', 'plan','time'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'amount_type' => 'required',
            'name' => 'required',
            'lifetime_status' => 'required',
            'times' => 'numeric|min:0',
            'interest' => 'numeric|min:0',
        ]);

        if ($request->amount_type == 'on') {
            $fixed_amount = $request->amount;
            $minimum = $request->amount;
            $maximum= $request->amount;
        }else{
            $fixed_amount = 0;
            $minimum = $request->minimum;
            $maximum= $request->maximum;
        }

        $interrest_status = ($request->interest_status == '%') ? 1 : 0;

        if ($request->lifetime_status == 'on'){
            $lifetime_status = 0;
            $repeat_time = $request->repeat_time;
        }else{
            $lifetime_status = 1;
            $repeat_time = 0;
        }

        if ($request->capital_back_status == 'on'){
            $capital_back_status =  ($lifetime_status == 1) ? 0 : 1;
        }else{
            $capital_back_status = 0;
        }


        if ($minimum < 0 or $maximum < 0 or $fixed_amount < 0){
			
        $notification =  array('danger' => 'Invest Amount cannot be lower than 0', 'alert-type' => 'danger');
        return back()->with($notification); 
        }

        if ($request->interest < 0){
        $notification =  array('danger' => 'Interest cannot be  lower than 0', 'alert-type' => 'danger');
        return back()->with($notification); 
        }

        if ($repeat_time < 0){
        $notification =  array('danger' => 'Return cannot be lower than 0', 'alert-type' => 'danger');
        return back()->with($notification); 
        }


        Plan::whereId($id)->update([
            'name' => $request->name,
            'minimum' => $minimum,
            'maximum' => $maximum,
            'fixed_amount' => $fixed_amount,
            'interest' => $request->interest,
            'interest_status' => $interrest_status,
            'times' => $request->times, 
            'capital_back_status' => $capital_back_status,
            'lifetime_status' => $lifetime_status,
            'repeat_time' => $repeat_time,
            'status' => $request->status,
            'featured' => ($request->featured == 'on') ? 1 : 0
        ]);

        $notification =  array('success' => 'Plan Updated succesfully', 'alert-type' => 'success');
        return back()->with($notification); 

    }

}
