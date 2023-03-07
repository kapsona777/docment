<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ValidationText;
use App\NotificationText;
class ValidationTextController extends Controller
{
    public function index(){
        $text=ValidationText::first();
        return view('admin.validation-text.index',compact('text'));
    }

    public function update(Request $request){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'unique_email'=>'required',
            'valid_email'=>'required',
            'password'=>'required',
            'confirm_password'=>'required',
            'minimum_password'=>'required',
            'phone'=>'required',
            'subject'=>'required',
            'message'=>'required',
            'comment'=>'required',
            'transaction_info'=>'required',
            'age'=>'required',
            'occupation'=>'required',
            'gender'=>'required',
            'address'=>'required',
            'country'=>'required',
            'city'=>'required',
        ]);

        unset($request['_token']);

        $text=ValidationText::first();
        ValidationText::where('id',$text->id)->update($request->all());
        $notification=array(
            'messege'=>'Update Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }

    public function notification(){
        $text=NotificationText::first();
        return view('admin.notification-text.index',compact('text'));
    }

    public function updateNotification(Request $request){
        $this->validate($request,[
            'login_success'=>'required',
            'login_credential'=>'required',
            'inactive_user'=>'required',
            'invalid_email'=>'required',
            'logout_success'=>'required',
            'register_confirm'=>'required',
            'successfull_verification'=>'required',
            'invalid_token'=>'required',
            'forget_password'=>'required',
            'contact_message'=>'required',
            'appointment_added'=>'required',
            'appointment_removed'=>'required',
            'fill_up_profile'=>'required',
            'payment_successfull'=>'required',
            'payment_faild'=>'required',
            'account_update'=>'required',
            'password_change'=>'required',
            'comment_success'=>'required',
            'verify_subscribe'=>'required',
            'already_subscribe'=>'required',
            'successfully_subscribe'=>'required',
        ]);

        unset($request['_token']);

        $text=NotificationText::first();
        NotificationText::where('id',$text->id)->update($request->all());
        $notification=array(
            'messege'=>'Update Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }
}
