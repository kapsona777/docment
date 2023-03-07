<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
use Hash;
use App\BannerImage;
class LoginController extends Controller
{


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('adminLogout');
    }


    public function adminLoginForm(){
        $isAdmin=Admin::all()->count();
        $image=BannerImage::first();
        return view('admin.auth.login',compact('isAdmin','image'));
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

        $isAdmin=Admin::where('email',$request->email)->first();
        if($isAdmin){
            if($isAdmin->status==1){
                if(Hash::check($request->password,$isAdmin->password)){
                    if(Auth::guard('admin')->attempt($credential,$request->remember)){
                        $notification=array(
                            'messege'=>'Login Successfully',
                            'alert-type'=>'success'
                        );
                        return Redirect()->intended(route('admin.dashboard'))->with($notification);
                    }

                    $notification=array(
                        'messege'=>'Login Faild, Try Again.',
                        'alert-type'=>'error'
                    );
                    return Redirect()->back()->with($notification);
                }else{
                    $notification=array(
                        'messege'=>'Credentials Invalid',
                        'alert-type'=>'error'
                    );
                    return Redirect()->back()->with($notification);
                }

            }else{
                $notification=array(
                    'messege'=>'Your admin account is in-active',
                    'alert-type'=>'error'
                );
                return Redirect()->back()->with($notification);
            }

        }else{
            $notification=array(
                'messege'=>'Credentials Invalid',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }



    }

    public function adminLogout(){
        Auth::guard('admin')->logout();
        $notification=array(
            'messege'=>'Logout Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('admin.login')->with($notification);
    }

    public function register(Request $request){
        $this->validate($request,[
            'email'=>'required|email',
            'name'=>'required',
            'password'=>'required',
        ]);

        $admin=new Admin();
        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->password=Hash::make($request->password);
        $admin->status=1;
        $admin->admin_type=1;
        $admin->save();

        $notification=array(
            'messege'=>'Register Successfully, Please Login Here',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.login')->with($notification);
    }

}
