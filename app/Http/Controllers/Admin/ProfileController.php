<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
use App\BannerImage;
use Image;
use Hash;
use File;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function profile(){
        $admin=Auth::guard('admin')->user();
        $default_profile=BannerImage::first();
        return view('admin.profile.index',compact('admin','default_profile'));
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
            'email'=>'required',
            'password'=>'confirmed',
        ]);

        $image_name=$request->old_image;
        // inset user profile image
        if($request->file('image')){

            $admin_data=Admin::first();
            if(File::exists('public/'.$admin_data->image))unlink('public/'.$admin_data->image);

            $user_image=$request->image;
            $extention=$user_image->getClientOriginalExtension();
            $image_name= $request->name.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/website-images/'.$image_name;
            Image::make($user_image)
                    ->resize(155,155)
                    ->save('public/'.$image_name);
        }

        if($request->password){
            Admin::where('id',Auth::guard('admin')->user()->id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'image'=>$image_name,
                'password'=>Hash::make($request->password)
            ]);
        }else{
            Admin::where('id',Auth::guard('admin')->user()->id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'image'=>$image_name
            ]);
        }


        $notification=array(
            'messege'=>'Your Account Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.profile')->with($notification);


    }
}
