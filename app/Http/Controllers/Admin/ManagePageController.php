<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ManagePage;
use App\ManageNavigation;
class ManagePageController extends Controller
{
    protected $page;
    protected $navigation;
    public function __construct(){
        $this->middleware('auth:admin');
        $this->page=ManagePage::first();
        $this->navigation=ManageNavigation::first();
    }
    public function homePage(){
        $navigation= $this->navigation;
        $page=$this->page;
        return view('admin.pages.home',compact('page','navigation'));
    }

    public function homePageUpdate(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'home_title'=>'required',
            'home_meta_description'=>'required',
            'show_navbar'=>'required'
        ]);

        // update homepage title or description
        ManagePage::where('id',$this->page->id)->update([
            'home_title'=>$request->home_title,
            'home_meta_description'=>$request->home_meta_description,
        ]);
        // update home navbar status
        ManageNavigation::where('id',$this->navigation->id)->update(['show_homepage'=>$request->show_navbar]);

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.home.page')->with($notification);
    }

    public function aboutUs(){
        $navigation= $this->navigation;
        $page=$this->page;
        return view('admin.pages.about-us',compact('page','navigation'));
    }

    public function aboutUsUpdate(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'aboutus_title'=>'required',
            'aboutus_meta_description'=>'required',
            'show_navbar'=>'required'
        ]);

        // update about us title or description
        ManagePage::where('id',$this->page->id)->update([
            'aboutus_title'=>$request->aboutus_title,
            'aboutus_meta_description'=>$request->aboutus_meta_description,
        ]);
        // update about us navbar status
        ManageNavigation::where('id',$this->navigation->id)->update(['show_aboutus'=>$request->show_navbar]);

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.aboutus.page')->with($notification);
    }

    public function doctor(){
        $navigation= $this->navigation;
        $page=$this->page;
        return view('admin.pages.doctor',compact('page','navigation'));
    }

    public function doctorUpdate(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'doctor_title'=>'required',
            'doctor_meta_description'=>'required',
            'show_navbar'=>'required'
        ]);

        // update doctor title or description
        ManagePage::where('id',$this->page->id)->update([
            'doctor_title'=>$request->doctor_title,
            'doctor_meta_description'=>$request->doctor_meta_description,
        ]);
        // update doctor navbar status
        ManageNavigation::where('id',$this->navigation->id)->update(['show_doctor'=>$request->show_navbar]);

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.doctor-page')->with($notification);
    }

    public function department(){
        $navigation= $this->navigation;
        $page=$this->page;
        return view('admin.pages.department',compact('page','navigation'));
    }

    public function departmentUpdate(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $this->validate($request,[
            'department_title'=>'required',
            'department_meta_description'=>'required',
            'show_navbar'=>'required'
        ]);

        // update doctor title or description
        ManagePage::where('id',$this->page->id)->update([
            'department_title'=>$request->department_title,
            'department_meta_description'=>$request->department_meta_description,
        ]);
        // update doctor navbar status
        ManageNavigation::where('id',$this->navigation->id)->update(['show_department'=>$request->show_navbar]);

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.department-page')->with($notification);
    }

    public function service(){
        $navigation= $this->navigation;
        $page=$this->page;
        return view('admin.pages.service',compact('page','navigation'));
    }

    public function serviceUpdate(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'service_title'=>'required',
            'service_meta_description'=>'required',
            'show_navbar'=>'required'
        ]);

        // update doctor title or description
        ManagePage::where('id',$this->page->id)->update([
            'service_title'=>$request->service_title,
            'service_meta_description'=>$request->service_meta_description,
        ]);
        // update doctor navbar status
        ManageNavigation::where('id',$this->navigation->id)->update(['show_service'=>$request->show_navbar]);

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.service-page')->with($notification);
    }

    public function testimonial(){
        $navigation= $this->navigation;
        $page=$this->page;
        return view('admin.pages.testimonial',compact('page','navigation'));
    }

    public function testimonialUpdate(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end



        $this->validate($request,[
            'testimonial_title'=>'required',
            'testimonial_meta_description'=>'required',
            'show_navbar'=>'required'
        ]);

        // update doctor title or description
        ManagePage::where('id',$this->page->id)->update([
            'testimonial_title'=>$request->testimonial_title,
            'testimonial_meta_description'=>$request->testimonial_meta_description,
        ]);
        // update doctor navbar status
        ManageNavigation::where('id',$this->navigation->id)->update(['show_testimonial'=>$request->show_navbar]);

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.testimonial.page')->with($notification);
    }

    public function faq(){
        $navigation= $this->navigation;
        $page=$this->page;
        return view('admin.pages.faq',compact('page','navigation'));
    }

    public function faqUpdate(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $this->validate($request,[
            'faq_title'=>'required',
            'faq_meta_description'=>'required',
            'show_navbar'=>'required'
        ]);

        // update doctor title or description
        ManagePage::where('id',$this->page->id)->update([
            'faq_title'=>$request->faq_title,
            'faq_meta_description'=>$request->faq_meta_description,
        ]);
        // update doctor navbar status
        ManageNavigation::where('id',$this->navigation->id)->update(['show_faq'=>$request->show_navbar]);

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.faq.page')->with($notification);
    }

    public function blog(){
        $navigation= $this->navigation;
        $page=$this->page;
        return view('admin.pages.blog',compact('page','navigation'));
    }

    public function blogUpdate(Request $request){


        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'blog_title'=>'required',
            'blog_meta_description'=>'required',
            'show_navbar'=>'required'
        ]);

        // update doctor title or description
        ManagePage::where('id',$this->page->id)->update([
            'blog_title'=>$request->blog_title,
            'blog_meta_description'=>$request->blog_meta_description,
        ]);
        // update doctor navbar status
        ManageNavigation::where('id',$this->navigation->id)->update(['show_blog'=>$request->show_navbar]);

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.blog.page')->with($notification);
    }

    public function contactUs(){
        $navigation= $this->navigation;
        $page=$this->page;
        return view('admin.pages.contact',compact('page','navigation'));
    }

    public function contactUsUpdate(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $this->validate($request,[
            'contactus_title'=>'required',
            'contactus_meta_description'=>'required',
            'show_navbar'=>'required'
        ]);

        // update doctor title or description
        ManagePage::where('id',$this->page->id)->update([
            'contactus_title'=>$request->contactus_title,
            'contactus_meta_description'=>$request->contactus_meta_description,
        ]);
        // update doctor navbar status
        ManageNavigation::where('id',$this->navigation->id)->update(['show_contactus'=>$request->show_navbar]);

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.contactus.page')->with($notification);
    }
}
