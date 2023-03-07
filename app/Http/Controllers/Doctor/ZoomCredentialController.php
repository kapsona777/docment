<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\ZoomCredential;
class ZoomCredentialController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth:doctor');
    }

    public function index(){

        $doctor=Auth::guard('doctor')->user();

        $credential=ZoomCredential::where('doctor_id',$doctor->id)->first();

        return view('doctor.zoom.setting.index',compact('credential'));
    }

    public function store(Request $request){

            // project demo mode check
    if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
    }
    // end

        $this->validate($request,[
            'zoom_api_key'=>'required',
            'zoom_api_secret'=>'required',
        ]);

        $doctor=Auth::guard('doctor')->user();
        $credential=new ZoomCredential();
        $credential->doctor_id=$doctor->id;
        $credential->zoom_api_key=$request->zoom_api_key;
        $credential->zoom_api_secret=$request->zoom_api_secret;
        $credential->save();


        $notification=array(
            'messege'=>'Created Successfully',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }

    public function update(Request $request,$id){

            // project demo mode check
    if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
    }
    // end

        $this->validate($request,[
            'zoom_api_key'=>'required',
            'zoom_api_secret'=>'required',
        ]);

        $doctor=Auth::guard('doctor')->user();

        $credential=ZoomCredential::find($id);
        $credential->doctor_id=$doctor->id;
        $credential->zoom_api_key=$request->zoom_api_key;
        $credential->zoom_api_secret=$request->zoom_api_secret;
        $credential->save();


        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }
}
