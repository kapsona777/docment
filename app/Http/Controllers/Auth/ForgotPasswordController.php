<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\User;
use App\Mail\ForgetPassword;
use Str;
use Mail;
use Hash;
use Auth;
use App\Rules\Captcha;
use App\Setting;
use App\BannerImage;
use App\Navigation;
use App\ManageText;
use App\EmailTemplate;
use App\ValidationText;
use App\NotificationText;
use App\Helpers\MailHelper;

class ForgotPasswordController extends Controller
{
   public function forgetPassword(){
        $setting=Setting::first();
        $banner=BannerImage::first();
        $navigation=Navigation::first();
        $text=ManageText::first();
        return view('patient.profile.auth.forget-password')->with(['setting'=>$setting,'banner'=>$banner,'navigation'=>$navigation,'text'=>$text]);
   }

   public function sendForgetEmail(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $errors=ValidationText::first();
        $rules = [
            'email'=>'required|email',
            'g-recaptcha-response'=>new Captcha()
        ];

        $customMessages = [
            'email.required' => $errors->email,
            'email.email' => $errors->valid_email,
        ];

        $this->validate($request, $rules, $customMessages);

        $user=User::where('email',$request->email)->first();
        $notify=NotificationText::first();
        if($user){
            $user->forget_password_token=Str::random(100);
            $user->save();

            $template=EmailTemplate::where('id',1)->first();
            $message=$template->description;
            $subject=$template->subject;
            $message=str_replace('{{name}}',$user->name,$message);
            MailHelper::setMailConfig();
            Mail::to($user->email)->send(new ForgetPassword($user,$message,$subject));
            $notification=array(
                'messege'=>$notify->forget_password,
                'alert-type'=>'success'
            );
            return back()->with($notification);

        }else{
            $notification=array(
                'messege'=>$notify->invalid_email,
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }

   }

   public function resetPassword($token){
        $user=User::where('forget_password_token',$token)->first();
        $notify=NotificationText::first();
        if($user){
            $setting=Setting::first();
            $banner=BannerImage::first();
            $navigation=Navigation::first();
            $text=ManageText::first();
            return view('patient.profile.auth.reset-password',compact('user','token','setting','banner','navigation','text'));
        }else{
            $notification=array(
                'messege'=>$notify->invalid_token,
                'alert-type'=>'error'
            );

            return Redirect()->route('forget.password')->with($notification);
        }
   }


   public function storeResetData(Request $request,$token){

        $errors=ValidationText::first();
        $rules = [
            'email'=>'required|email',
            'password'=>'required|confirmed|min:6',
            'g-recaptcha-response'=>new Captcha()
        ];

        $customMessages = [
            'email.required' => $errors->email,
            'email.email' => $errors->valid_email,
            'password.required' => $errors->password,
            'password.confirmed' => $errors->confirm_password,
            'password.min' => $errors->minimum_password,
        ];

        $this->validate($request, $rules, $customMessages);

        $notify=NotificationText::first();
        $user=User::where('forget_password_token',$token)->first();
        if($user->email==$request->email){
            $user->password=Hash::make($request->password);
            $user->forget_password_token=null;
            $user->save();

            $notification=array(
                'messege'=>$notify->password_change,
                'alert-type'=>'success'
            );
            return Redirect()->route('login')->with($notification);

        }else{
            $notification=array(
                'messege'=>$notify->invalid_email,
                'alert-type'=>'error'
            );

            return back()->with($notification);
        }
   }


}
