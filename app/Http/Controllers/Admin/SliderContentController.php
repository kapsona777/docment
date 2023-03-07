<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
class SliderContentController extends Controller
{
    public function index(){
        $content=Setting::first();
        return view('admin.slider.content.index',compact('content'));
    }

    public function update(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'slider_heading'=>'required',
            'slider_description'=>'required',
        ]);

        Setting::where('id',$id)->update([
            'slider_heading'=>$request->slider_heading,
            'slider_description'=>$request->slider_description,
        ]);

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }
}
