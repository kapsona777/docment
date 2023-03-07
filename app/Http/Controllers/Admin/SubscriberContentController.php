<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
class SubscriberContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $setting=Setting::first();
        return view('admin.subscriber.content.index',compact('setting'));
    }

    public function Update(Request $request,$id){

         // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'subscribe_heading'=>'required',
            'subscribe_description'=>'required'
        ]);

        Setting::where('id',$id)->update([
            'subscribe_heading'=>$request->subscribe_heading,
            'subscribe_description'=>$request->subscribe_description,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }
}
