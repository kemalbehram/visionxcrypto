<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\TimeSetting;
use Illuminate\Http\Request;

class TimeSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "Manage Time Settings";
        $team = TimeSetting::all();
        return view('admin.time_setting.index', compact('page_title', 'team'));
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
            'time' => 'required|numeric|min:0'
        ]);

        TimeSetting::create($request->all());
        $notification =  array('success' => 'Investment timer created successfully', 'alert-type' => 'success');
        return back()->with($notification); 

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TimeSetting  $timeSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TimeSetting $timeSetting, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'time' => 'required|numeric|min:0'
        ]);

        TimeSetting::whereId($id)->update($request->except(['_method', '_token']));

        $notification =  array('success' => 'Investment timer updated successfully', 'alert-type' => 'success');
        return back()->with($notification); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TimeSetting  $timeSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeSetting $timeSetting ,$id)
    {
        TimeSetting::whereId($id)->delete();
        $notification =  array('success' => 'Investment timer deleted successfully', 'alert-type' => 'success');
        return back()->with($notification); 
    }
}
