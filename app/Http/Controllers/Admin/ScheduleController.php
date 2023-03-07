<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Schedule;
use App\Appointment;
use App\Day;
use App\Doctor;
use Illuminate\Http\Request;

class ScheduleController extends Controller
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
        $schedules=Schedule::with('day','doctor')->get();
        $appointments=Appointment::all();
        return view('admin.schedule.index',compact('schedules','appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $days=Day::all();
        $doctors=Doctor::all();
        return view('admin.schedule.create',compact('days','doctors'));
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
            'doctor'=>'required',
            'day'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'quantity'=>'required',
            'status'=>'required'
        ]);

        Schedule::create([
            'doctor_id'=>$request->doctor,
            'day_id'=>$request->day,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
            'quantity'=>$request->quantity,
            'status'=>$request->status,
        ]);

        $notification=array(
            'messege'=>'Created Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $days=Day::all();
        $doctors=Doctor::all();
        return view('admin.schedule.edit',compact('schedule','days','doctors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {


            // project demo mode check
            if(env('PROJECT_MODE')==0){
                $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
                return redirect()->back()->with($notification);
            }
            // end


        $this->validate($request,[
            'doctor'=>'required',
            'day'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'quantity'=>'required',
            'status'=>'required'
        ]);


            $schedule->doctor_id=$request->doctor;
            $schedule->day_id=$request->day;
            $schedule->start_time=$request->start_time;
            $schedule->end_time=$request->end_time;
            $schedule->quantity=$request->quantity;
            $schedule->status=$request->status;
            $schedule->save();

        $notification=array(
            'messege'=>'update Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.schedule.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {

            // project demo mode check
            if(env('PROJECT_MODE')==0){
                $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
                return redirect()->back()->with($notification);
            }
            // end


        $schedule->delete();
        $notification=array(
            'messege'=>'Deleted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.schedule.index')->with($notification);
    }

     // manage blog status
     public function changeStatus($id){
        $schedule=Schedule::find($id);
        if($schedule->status==1){
            $schedule->status=0;
            $message="In-active Successfully";
        }else{
            $schedule->status=1;
            $message="Active Successfully";
        }
        $schedule->save();
        return response()->json($message);

    }
}
