<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use App\Rules\Captcha;
use App\Setting;
use App\BannerImage;
use App\Navigation;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;

class LoginController extends Controller
{


    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest:web')->except('userLogout');
    }

    public function userLoginPage(){
        $setting=Setting::first();
        $banner=BannerImage::first();
        $navigation=Navigation::first();
        $text=ManageText::first();
        return view('patient.profile.auth.login')->with(['setting'=> $setting,'banner'=>$banner,'navigation'=>$navigation,'text'=>$text]);
    }

    public function storeLogin(Request $request){
        $errors=ValidationText::first();
        $rules = [
            'email'=>'required',
            'password'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];

        $customMessages = [

            'email.required' => $errors->email,
            'email.email' => $errors->valid_email,
            'password.required' => $errors->password,
        ];

        $this->validate($request, $rules, $customMessages);

        $credential=[
            'email'=> $request->email,
            'password'=> $request->password
        ];

        $notify=NotificationText::first();
        $user=User::where('email',$request->email)->first();
        if($user){
            if($user->status==1){
                if(Hash::check($request->password,$user->password)){
                    if(Auth::guard('web')->attempt($credential,$request->remember)){
                        $notification=array(
                            'messege'=>$notify->login_success,
                            'alert-type'=>'success'
                        );
                        return Redirect()->intended(route('patient.dashboard'))->with($notification);
                    }
                }else{
                    $notification=array(
                        'messege'=>$notify->login_credential,
                        'alert-type'=>'error'
                    );

                    return Redirect()->back()->with($notification);
                }

            }else{
                $notification=array(
                    'messege'=>$notify->inactive_user,
                    'alert-type'=>'error'
                );

                return Redirect()->back()->with($notification);
            }
        }else{
            $notification=array(
                'messege'=>$notify->invalid_email,
                'alert-type'=>'error'
            );

            return Redirect()->back()->with($notification);
        }
    }

    public function userLogout(){
        Auth::guard('web')->logout();
        $notification=array(
            'messege'=>'Logout Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('login')->with($notification);
    }
}
