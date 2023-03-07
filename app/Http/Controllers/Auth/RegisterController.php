<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Mail\UserVerification;
use Str;
use Mail;
use App\Rules\Captcha;
use App\Setting;
use App\BannerImage;
use App\Navigation;
use App\ManageText;
use App\EmailTemplate;
use App\ValidationText;
use App\NotificationText;
use App\Helpers\MailHelper;

class RegisterController extends Controller
{


    use RegistersUsers;


    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest:web');
    }


    public function userRegisterPage(){
        $setting=Setting::first();
        $banner=BannerImage::first();
        $navigation=Navigation::first();
        $text=ManageText::first();
        return view('patient.profile.auth.register')->with(['setting'=>$setting,'banner'=>$banner,'navigation'=>$navigation,'text'=>$text]);
    }

    public function storeRegister(Request $request){
            // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $errors=ValidationText::first();
        $notify=NotificationText::first();
        $rules = [
            'name'=>'required',
            'email'=>'required|unique:users|email',
            'password'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];

        $customMessages = [
            'name.required' => $errors->name,
            'email.required' => $errors->email,
            'email.email' => $errors->valid_email,
            'email.unique' => $errors->unique_email,
            'password.required' => $errors->password,
            'password.min' => $errors->minimum_password,
        ];

        $this->validate($request, $rules, $customMessages);

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'patient_id'=>date('ymdis'),
            'email_verified_token'=>Str::random(100)
        ]);

        $template=EmailTemplate::where('id',5)->first();
        $message=$template->description;
        $subject=$template->subject;
        $message=str_replace('{{user_name}}',$user->name,$message);
        MailHelper::setMailConfig();
        Mail::to($user->email)->send(new UserVerification($user,$message,$subject));

        $notification=array(
            'messege'=>$notify->register_confirm,
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function userVerify($token){
        $user=User::where('email_verified_token',$token)->first();
        $notify=NotificationText::first();
        if($user){
            $user->email_verified_token=null;
            $user->status=1;
            $user->email_verified=1;
            $user->save();
            $notification=array(
                'messege'=>$notify->successfull_verification,
                'alert-type'=>'success'
            );
            return  redirect()->route('login')->with($notification);
        }else{

            $notification=array(
                'messege'=>$notify->invalid_token,
                'alert-type'=>'error'
            );
            return redirect()->route('register')->with($notification);
        }
    }
}
