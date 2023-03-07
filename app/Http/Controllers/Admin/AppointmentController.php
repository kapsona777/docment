<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Appointment;
use App\Setting;
class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function pendingAppointment(){
        $appointments=Appointment::where('payment_status',0)->get();
        return view('admin.appointment.pending',compact('appointments'));
    }

    public function newAppointment(){
        $appointments=Appointment::where(['payment_status'=>1,'already_treated'=>0])->orderBy('id','desc')->get();
        return view('admin.appointment.new',compact('appointments'));
    }

    public function allAppointment(){
        $appointments=Appointment::orderBy('id','desc')->get();
        return view('admin.appointment.all',compact('appointments'));
    }



    public function show($id){
        $appointment=Appointment::find($id);
        $currency=Setting::first();
        return view('admin.appointment.show',compact('appointment','currency'));
    }

    public function approvedPayment($id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        // end

        Appointment::where('id',$id)->update(['payment_status'=>1]);
        $notification=array(
            'messege'=>'Created Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }
}
