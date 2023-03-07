<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\EmailConfiguration;

class EmailConfigurationController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        $email=EmailConfiguration::first();
        return view('admin.email-configuration.index',compact('email'));
    }

    public function update(Request $request){

         // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array(
            'messege'=>env('NOTIFY_TEXT'),
            'alert-type'=>'error'
            );

        return redirect()->back()->with($notification);
        }
        // end

        $rules = [
            'email'=>'required',
            'mail_host'=>'required',
            'mail_port'=>'required',
            'mail_encryption'=>'required',
            'smtp_username'=>'required',
            'smtp_password'=>'required',

        ];


        $this->validate($request, $rules);

        $email=EmailConfiguration::first();
        $email->email=$request->email;
        $email->mail_host=$request->mail_host;
        $email->mail_port=$request->mail_port;
        $email->smtp_username=$request->smtp_username;
        $email->smtp_password=$request->smtp_password;
        $email->mail_encryption=$request->mail_encryption;
        $email->save();

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.email-configuration')->with($notification);

    }
}
