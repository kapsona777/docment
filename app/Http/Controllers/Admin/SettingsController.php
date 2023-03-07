<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;
use Config;
use App\Setting;
use App\ManageNavigation;
use App\About;
use App\Admin;
use App\Advice;
use App\Appointment;
use App\Blog;
use App\BlogCategory;
use App\BlogComment;

use App\CancelOrder;
use App\ConditionPrivacy;
use App\ContactInformation;
use App\ContactMessage;
use App\ContactUs;
use App\CustomePage;
use App\Department;
use App\DepartmentFaq;
use App\DepartmentImage;
use App\Doctor;
use App\DoctorSocialLink;

use App\Faq;
use App\FaqCategory;
use App\Feature;
use App\Habit;
use App\Leave;
use App\Location;
use App\ManagePage;
use App\Medicine;
use App\MedicineType;
use App\Order;
use App\Overview;
use App\Partner;

use App\PaymentAccount;
use App\Prescribe;
use App\Schedule;
use App\Service;
use App\ServiceImage;
use App\ServiceFaq;
use App\Slider;
use App\Subscribe;
use App\Testimonial;
use App\User;
use App\Video;
use App\Work;
use App\WorkFaq;
use App\EmailTemplate;
use App\MeetingHistory;
use App\ZoomMeeting;
use App\ZoomCredential;




class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting=Setting::first();
        if($setting){
            return view('admin.settings.index',compact('setting'));
        }{
            return view('admin.settings.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $this->validate($request,[
            'logo'=>'required',
            'favicon'=>'required',
            'email'=>'required',
            'currency_name'=>'required',
            'currency_icon'=>'required',
            'prenotification_hour'=>'required'
        ]);

        config(['app.timezone'=>$request->timezone]);

        // for logo
        $image=$request->logo;
        $ext=$image->getClientOriginalExtension();
        $logo_name= 'logo-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
        $logo_name='uploads/website-images/'.$logo_name;
        Image::make($image)
                ->resize(196,56)
                ->save('public/'.$logo_name);

        // for favicon
        $favicon=$request->favicon;
        $ext=$favicon->getClientOriginalExtension();
        $favicon_name= 'favicon-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
        $favicon_name='uploads/website-images/'.$favicon_name;
        Image::make($favicon)
                ->resize(100,100)
                ->save('public/'.$favicon_name);


        $setting=new Setting();
        $setting->email=$request->email;
        $setting->save_contact_message=$request->save_contact_message;
        $setting->patient_can_register=$request->patient_can_register;
        $setting->logo=$logo_name;
        $setting->favicon=$favicon_name;
        $setting->text_direction=$request->text_direction;
        $setting->currency_name=$request->currency_name;
        $setting->currency_icon=$request->currency_icon;
        $setting->prenotification_hour=$request->prenotification_hour;
        $setting->timezone=$request->timezone;
        $setting->save();


        $notification=array(
            'messege'=>'Created Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.settings.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $this->validate($request,[
            'email'=>'required',
            'currency_name'=>'required',
            'currency_icon'=>'required',
            'prenotification_hour'=>'required',
        ]);

        if($request->logo){
            // for logo
            $old_logo=$setting->logo;
            $image=$request->logo;
            $ext=$image->getClientOriginalExtension();
            $logo_name= 'logo-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $logo_name='uploads/website-images/'.$logo_name;
            $logo=Image::make($image)
                    ->save('public/'.$logo_name);
            $setting->logo=$logo_name;
            if(File::exists('public/'.$old_logo))unlink('public/'.$old_logo);
        }


        if($request->favicon){
            // for favicon
            $old_favicon=$setting->favicon;
            $favicon=$request->favicon;
            $ext=$favicon->getClientOriginalExtension();
            $favicon_name= 'favicon-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $favicon_name='uploads/website-images/'.$favicon_name;
            Image::make($favicon)
                    ->save('public/'.$favicon_name);
            $setting->favicon=$favicon_name;
            if(File::exists('public/'.$old_favicon))unlink('public/'.$old_favicon);
        }

        $setting->email=$request->email;
        $setting->save_contact_message=$request->save_contact_message;
        $setting->patient_can_register=$request->patient_can_register;
        // $setting->text_direction=$request->text_direction;
        $setting->currency_name=$request->currency_name;
        $setting->currency_icon=$request->currency_icon;
        $setting->prenotification_hour=$request->prenotification_hour;
        $setting->timezone=$request->timezone;
        $setting->save();
        $notification=array(
            'messege'=>'update Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.settings.index')->with($notification);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }

    public function blogCommentSetting(){
        $setting=Setting::first();
        return view('admin.settings.blog-comment.index',compact('setting'));
    }

    public function updateCommentSetting(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        if($request->comment_type==0){
            $this->validate($request,[
                'facebook_comment_script'=>'required'
            ]);
        }

        $setting=Setting::first();
        $setting->comment_type=$request->comment_type;
        $setting->facebook_comment_script=$request->facebook_comment_script;
        $setting->save();
        $notification=array(
            'messege'=>'update Successfully',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }


    public function cookieConsentSetting(){
        $setting=Setting::first();
        return view('admin.settings.cookie-consent.index',compact('setting'));
    }

    public function updateCookieConsentSetting(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        if($request->allow_cookie_consent==1){
            $this->validate($request,[
                'cookie_text'=>'required',
                'cookie_button_text'=>'required'
            ]);
        }

        $setting=Setting::first();
        $setting->allow_cookie_consent=$request->allow_cookie_consent;
        $setting->cookie_text=$request->cookie_text;
        $setting->cookie_button_text=$request->cookie_button_text;
        $setting->save();
        $notification=array(
            'messege'=>'update Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    public function captchaSetting(){
        $setting=Setting::first();
        return view('admin.settings.google-captcha.index',compact('setting'));
    }

    public function updateCaptchaSetting(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        if($request->allow_captcha==1){
            $this->validate($request,[
                'captcha_key'=>'required',
                'captcha_secret'=>'required',
            ]);
        }

        $setting=Setting::first();
        $setting->allow_captcha=$request->allow_captcha;
        $setting->captcha_key=$request->captcha_key;
        $setting->captcha_secret=$request->captcha_secret;
        $setting->save();
        $notification=array(
            'messege'=>'update Successfully',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }

    public function clearDatabase(){
        return view('admin.settings.clear-database.index');
    }

    public function destroyDatabase(){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        Advice::truncate();
        Appointment::truncate();
        Blog::truncate();
        BlogCategory::truncate();
        BlogComment::truncate();
        CancelOrder::truncate();
        ConditionPrivacy::truncate();
        ContactMessage::truncate();
        CustomePage::truncate();
        Department::truncate();
        DepartmentFaq::truncate();
        DepartmentImage::truncate();
        Doctor::truncate();
        DoctorSocialLink::truncate();
        Faq::truncate();
        FaqCategory::truncate();
        Feature::truncate();
        Habit::truncate();
        Leave::truncate();
        Location::truncate();
        Medicine::truncate();
        MedicineType::truncate();
        Order::truncate();
        Prescribe::truncate();
        Schedule::truncate();
        Service::truncate();
        ServiceImage::truncate();
        ServiceFaq::truncate();
        Subscribe::truncate();
        Testimonial::truncate();
        User::truncate();
        Video::truncate();
        Partner::truncate();
        WorkFaq::truncate();
        Overview::truncate();
        MeetingHistory::truncate();
        ZoomMeeting::truncate();
        ZoomCredential::truncate();




        $folderPath = public_path('uploads/custom-images');
        $response = File::deleteDirectory($folderPath);

        $path = public_path('uploads/custom-images');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);

        }

        $notification=array(
            'messege'=>'Database Cleared Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('admin.dashboard')->with($notification);

    }


    public function livechatSetting(){
        $setting=Setting::first();
        return view('admin.settings.live-chat.index',compact('setting'));
    }

    public function updateLivechatSetting(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        if($request->live_chat==1){
            $this->validate($request,[
                'livechat_script'=>'required'
            ]);
        }

        $setting=Setting::first();
        $setting->live_chat=$request->live_chat;
        $setting->livechat_script=$request->livechat_script;
        $setting->save();
        $notification=array(
            'messege'=>'update Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);

    }

    public function preloaderSetting(){
        $setting=Setting::first();
        if($setting->preloader_image){
            return view('admin.settings.preloader.index',compact('setting'));
        }else{
            return view('admin.settings.preloader.create',compact('setting'));
        }
    }

    public function preloaderUpdate(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $setting=Setting::find($id);
        if($request->preloader_image){

            $old_preloader=$setting->preloader_image;

            unlink(public_path($old_preloader));
            $ext = $request->file('preloader_image')->extension();
            $final_name = 'preloader_image-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $request->file('preloader_image')->move(public_path('uploads/website-images/'), $final_name);
            $setting->preloader_image='uploads/website-images/'.$final_name;
            $setting->save();

        }else{
            $setting->preloader=$request->preloader;
            $setting->save();
        }

        $notification=array(
            'messege'=>'update Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    public function googleAnalytic(){
        $setting=Setting::first();
        return view('admin.settings.google-analytic.index',compact('setting'));
    }

    public function googleAnalyticUpdate(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        if($request->google_analytic==1){
            $this->validate($request,[
                'google_analytic_code'=>'required'
            ]);
        };

        $setting=Setting::first();
        $setting->google_analytic=$request->google_analytic;
        $setting->google_analytic_code=$request->google_analytic_code;
        $setting->save();
        $notification=array(
            'messege'=>'update Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);

    }

    public function themeColor(){
        $setting=Setting::first();
        return view('admin.settings.theme-color.index',compact('setting'));
    }

    public function themeColorUpdate(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $setting=Setting::first();
        $setting->theme_one=$request->theme_one;
        $setting->theme_two=$request->theme_two;
        $setting->save();
        $notification=array(
            'messege'=>'update Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    public function emailTemplate(){
        $templates=EmailTemplate::all();
        return view('admin.settings.email-template.index',compact('templates'));
    }

    public function editEmail($id){

        $email=EmailTemplate::find($id);
        if($id==1){
            return view('admin.settings.email-template.reset-edit',compact('email'));
        }else if($id==2){
            return view('admin.settings.email-template.contact-edit',compact('email'));
        }else if($id==3){
            return view('admin.settings.email-template.doctor-login-edit',compact('email'));
        }else if($id==4){
            return view('admin.settings.email-template.subscribe-edit',compact('email'));
        }else if($id==5){
            return view('admin.settings.email-template.verification-edit',compact('email'));
        }else if($id==6){
            return view('admin.settings.email-template.order-edit',compact('email'));
        }else if($id==7){
            return view('admin.settings.email-template.pre-notification',compact('email'));
        }else if($id==8){
            return view('admin.settings.email-template.zoom',compact('email'));
        }
    }

    public function updateEmail(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $this->validate($request,[
            'subject'=>'required',
            'description'=>'required',
        ]);

        EmailTemplate::where('id',$id)->update([
            'subject'=>$request->subject,
            'description'=>$request->description
        ]);

        $notification=array(
            'messege'=>'Update Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('admin.email.template')->with($notification);
    }

    public function prescriptionContact(){
        $setting=Setting::first();
        return view('admin.settings.prescription-contact.index',compact('setting'));
    }

    public function prescriptionContactUpdate(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'email'=>'required',
            'phone'=>'required'
        ]);

        $setting=Setting::first();
        $setting->prescription_phone=$request->phone;
        $setting->prescription_email=$request->email;
        $setting->save();
        $notification=array(
            'messege'=>'Update Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
}
