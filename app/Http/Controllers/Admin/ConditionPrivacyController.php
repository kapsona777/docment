<?php

namespace App\Http\Controllers\Admin;

use App\ConditionPrivacy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConditionPrivacyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $conditionPrivacy=ConditionPrivacy::first();
        if($conditionPrivacy){
            return view('admin.terms-privacy.edit',compact('conditionPrivacy'));
        }else{
            return view('admin.terms-privacy.create');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'terms_condition'=>'required',
            'privacy_policy'=>'required',
        ]);

        ConditionPrivacy::create([
            'terms_condition'=>$request->terms_condition,
            'privacy_policy'=>$request->privacy_policy
        ]);

        $notification=array(
            'messege'=>'Created Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.terms-privacy.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ConditionPrivacy  $conditionPrivacy
     * @return \Illuminate\Http\Response
     */
    public function show(ConditionPrivacy $conditionPrivacy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConditionPrivacy  $conditionPrivacy
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConditionPrivacy  $conditionPrivacy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'terms_condition'=>'required',
            'privacy_policy'=>'required',
        ]);

        ConditionPrivacy::where('id',$id)->update([
            'terms_condition'=>$request->terms_condition,
            'privacy_policy'=>$request->privacy_policy
        ]);

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.terms-privacy.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConditionPrivacy  $conditionPrivacy
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConditionPrivacy $conditionPrivacy)
    {
        //
    }
}
