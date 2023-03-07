<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Leave;
use Illuminate\Http\Request;
use Auth;
class LeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:doctor');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $leaves=Leave::where('doctor_id',Auth::guard('doctor')->user()->id)->get();
        return view('doctor.leave.index',compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
    }
    // end

        $this->validate($request,[
            'date'=>'required'
        ]);
        $doctor=Auth::guard('doctor')->user()->id;
        $date= date('Y-m-d',strtotime($request->date)) ;
        $exist=Leave::where(['date'=>$date,'doctor_id'=>$doctor])->count();
        if($exist ==0){
            Leave::create(['date'=>$date,'doctor_id'=>$doctor]);
            $notification=array(
                'messege'=>'Create Successfully',
                'alert-type'=>'success'
            );

            return redirect()->route('doctor.leave.index')->with($notification);
        }else{
            $notification=array(
                'messege'=>'This Date Already Exist',
                'alert-type'=>'error'
            );

            return redirect()->route('doctor.leave.index')->with($notification);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {

            // project demo mode check
    if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
    }
    // end

        $this->validate($request,[
            'date'=>'required'
        ]);

        Leave::where('id',$leave->id)->update(['date'=>$request->date]);
        $notification=array(
            'messege'=>'Update Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('doctor.leave.index')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {

            // project demo mode check
    if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
    }
    // end
        $leave->delete();
        $notification=array(
            'messege'=>'Deleted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('doctor.leave.index')->with($notification);
    }
}
