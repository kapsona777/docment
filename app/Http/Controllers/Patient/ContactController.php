<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ContactMessage;
use App\Setting;
use App\EmailTemplate;
use Mail;
use App\Mail\ContactMessageInformation;
use App\Rules\Captcha;
use App\ValidationText;
use App\NotificationText;
use App\Helpers\MailHelper;
class ContactController extends Controller
{
    public function message(Request $request){

            // project demo mode check
    if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
    }
    // end

        $errors=ValidationText::first();
        $rules = [
            'name'=>'required',
            'email'=>'required|email',
            'subject'=>'required',
            'message'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];

        $customMessages = [
            'name.required' => $errors->name,
            'email.required' => $errors->email,
            'email.email' => $errors->valid_email,
            'subject.required' => $errors->subject,
            'message.required' => $errors->message,
        ];

        $this->validate($request, $rules, $customMessages);

        $contact=[
            'email'=>$request->email,
            'phone'=>$request->phone,
            'name'=>$request->name,
            'subject'=>$request->subject,
            'message'=>$request->message,
        ];
        $setting=Setting::first();
        $notify=NotificationText::first();
        if($setting->save_contact_message==1){
            ContactMessage::create($contact);
        }

        $template=EmailTemplate::where('id',2)->first();
        $message=$template->description;
        $subject=$template->subject;
        $message=str_replace('{{name}}',$contact['name'],$message);
        $message=str_replace('{{email}}',$contact['email'],$message);
        $message=str_replace('{{phone}}',$contact['phone'],$message);
        $message=str_replace('{{subject}}',$contact['subject'],$message);
        $message=str_replace('{{message}}',$contact['message'],$message);

        MailHelper::setMailConfig();
        Mail::to($setting->email)->send(new ContactMessageInformation($message,$subject));


        $notification=array(
            'messege'=>$notify->contact_message,
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }
}
