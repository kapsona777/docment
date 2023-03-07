<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
use App\Doctor;
use App\BannerImage;
use Hash;
class LoginController extends Controller
{


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::DOCTOR;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:doctor')->except('doctorLogout');
    }


    public function doctorLoginForm(){
        $image=BannerImage::first();
        return view('doctor.auth.login',compact('image'));
    }

    public function storeLoginInfo(Request $request){
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $credential=[
            'email'=> $request->email,
            'password'=> $request->password
        ];

        $isDoctor=Doctor::where('email',$request->email)->first();
        if($isDoctor){
            if(Hash::check($request->password,$isDoctor->password)){
                if(Auth::guard('doctor')->attempt($credential,$request->remember)){
                    return Redirect()->intended(route('doctor.dashboard'));
                }
                return Redirect()->back()->withInput($request->only('email,remember'));
            }else{
                return Redirect()->back()->with(['invalidAdmin'=>'Credentials Invalid']);
            }

        }else{
            return Redirect()->back()->with(['invalidAdmin'=>'Credentials Invalid']);
        }



    }

    public function doctorLogout(){
        Auth::guard('doctor')->logout();
        return redirect()->route('doctor.login');
    }

}
