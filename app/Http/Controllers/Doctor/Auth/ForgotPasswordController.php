<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\User;
use App\Doctor;
use App\Mail\ForgetPassword;
use App\Mail\DoctorForgetPassword;
use Str;
use Mail;
use Hash;
use Auth;
use App\BannerImage;
use App\EmailTemplate;
use App\Helpers\MailHelper;

class ForgotPasswordController extends Controller
{
   public function forgetPassword(){
    $image=BannerImage::first();
       return view('doctor.auth.forget-password',compact('image'));
   }

   public function sendForgetEmail(Request $request){

    // project demo mode check
    if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
    }
    // end

        $this->validate($request,[
            'email'=>'required'
        ]);

        $doctor=Doctor::where('email',$request->email)->first();
        if($doctor){
            $doctor->forget_password_token=Str::random(100);
            $doctor->save();

            $template=EmailTemplate::where('id',1)->first();
            $message=$template->description;
            $subject=$template->subject;
            $message=str_replace('{{name}}',$doctor->name,$message);
            MailHelper::setMailConfig();
            Mail::to($doctor->email)->send(new DoctorForgetPassword($doctor,$message,$subject));
            return back()->with(['send-password'=>'Forgot Password has been Sent to Your Email. Please Check your email']);

        }else return Redirect()->back()->with(['invalidUser'=>'Email Does not Exist']);

   }

   public function resetPassword($token){
        $doctor=Doctor::where('forget_password_token',$token)->first();
        $image=BannerImage::first();
        if($doctor){
            return view('doctor.auth.reset-password',compact('doctor','token','image'));
        }else return Redirect()->route('doctor.forget.password')->with(['invalidUser'=>'Invalid Token. Please Try again']);
   }


   public function storeResetData(Request $request,$token){

        $this->validate($request,[
            'email'=>'required',
            'password'=>'required|confirmed|min:3'
        ]);
        $doctor=Doctor::where('forget_password_token',$token)->first();
        if($doctor->email==$request->email){
            $doctor->password=Hash::make($request->password);
            $doctor->forget_password_token=null;
            $doctor->save();

            $notification=array(
                'messege'=>'Please Login Here',
                'alert-type'=>'success'
            );
            return Redirect()->route('doctor.login')->with($notification);

        }else return back()->with(['invalidUser'=>'Email Does not match. try again.']);
   }


}
