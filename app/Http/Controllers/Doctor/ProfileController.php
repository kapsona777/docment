<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
use App\Location;
use App\Doctor;
use Auth;
use Image;
use File;
use Hash;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:doctor');
    }
    public function profile(){
        $doctor=Auth::guard('doctor')->user();
        return view('doctor.profile.index',compact('doctor'));
    }

    public function updateProfile(Request $request){

            // project demo mode check
    if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
    }
    // end

        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'designations'=>'required',
            'about'=>'required',
            'address'=>'required',
            'educations'=>'required',
            'experiences'=>'required',
            'qualifications'=>'required',
        ]);


        if($request->image){
            $old_image=$request->old_image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $name= 'doctor-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/custom-images/'.$name;
            Image::make($image)
                    ->resize(300,320)
                    ->save('public/'.$image_path);


            Doctor::where('id',Auth::guard('doctor')->user()->id)->update([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'image'=>$image_path,
                'designations'=>$request->designations,
                'facebook'=>$request->facebook,
                'twitter'=>$request->twitter,
                'linkedin'=>$request->linkedin,
                'about'=>$request->about,
                'address'=>$request->address,
                'educations'=>$request->educations,
                'experience'=>$request->experiences,
                'qualifications'=>$request->qualifications,
            ]);
            if(File::exists('public/'.$old_image))unlink('public/'.$old_image);
        }else{
            Doctor::where('id',Auth::guard('doctor')->user()->id)->update([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'designations'=>$request->designations,
                'facebook'=>$request->facebook,
                'twitter'=>$request->twitter,
                'linkedin'=>$request->linkedin,
                'about'=>$request->about,
                'address'=>$request->address,
                'educations'=>$request->educations,
                'experience'=>$request->experiences,
                'qualifications'=>$request->qualifications,
            ]);
        }



        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('doctor.profile')->with($notification);
    }


    public function changePassword(Request $request){

            // project demo mode check
    if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
    }
    // end

        $this->validate($request,[
            'password'=>'required|confirmed'
        ]);

        Doctor::where('id',Auth::guard('doctor')->user()->id)->update(['password'=>Hash::make($request->password)]);

        $notification=array(
            'messege'=>'Password Change Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('doctor.profile')->with($notification);
    }
}
