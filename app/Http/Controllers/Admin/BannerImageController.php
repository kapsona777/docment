<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BannerImage;
use Image;
use File;
class BannerImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $banner=BannerImage::first();
        return view('admin.banner-image.index',compact('banner'));
    }

    public function aboutBanner(Request $request){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        // end
        $this->validate($request,[
            'about_us'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->about_us){
            $oldImage=$banner->about_us;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }
        $image=$request->about_us;
        $extention=$image->getClientOriginalExtension();
        $name= 'about-us-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(1280,315)
                ->save('public/'.$image_path);

        BannerImage::where('id',$banner->id)->update([
            'about_us'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);

    }
    public function aboutUsBg(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'about_us_bg'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->about_us_bg){
            $oldImage=$banner->about_us_bg;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }
        $image=$request->about_us_bg;
        $extention=$image->getClientOriginalExtension();
        $name= 'about-us-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(480,480)
                ->save('public/'.$image_path);

        BannerImage::where('id',$banner->id)->update([
            'about_us_bg'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);

    }


    public function subscribe(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        // end
        $this->validate($request,[
            'subscribe_us'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->subscribe_us){
            $oldImage=$banner->subscribe_us;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }
        $image=$request->subscribe_us;
        $extention=$image->getClientOriginalExtension();
        $name= 'subscribe-us-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(1280,315)
                ->save('public/'.$image_path);

        BannerImage::where('id',$banner->id)->update([
            'subscribe_us'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);

    }

    public function doctor(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'doctor'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->doctor){
            $oldImage=$banner->doctor;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }
        $image=$request->doctor;
        $extention=$image->getClientOriginalExtension();
        $name= 'doctor-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(1280,315)
                ->save('public/'.$image_path);

        BannerImage::where('id',$banner->id)->update([
            'doctor'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);

    }
    public function service(Request $request){

                // project demo mode check
                if(env('PROJECT_MODE')==0){
                    $notification=array(
                        'messege'=>env('NOTIFY_TEXT'),
                        'alert-type'=>'error'
                    );
                    return redirect()->back()->with($notification);
                }
                // end

        $this->validate($request,[
            'service'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->service){
            $oldImage=$banner->service;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }
        $image=$request->service;
        $extention=$image->getClientOriginalExtension();
        $name= 'service-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(1280,315)
                ->save('public/'.$image_path);

        BannerImage::where('id',$banner->id)->update([
            'service'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);

    }
    public function department(Request $request){

                // project demo mode check
                if(env('PROJECT_MODE')==0){
                    $notification=array(
                        'messege'=>env('NOTIFY_TEXT'),
                        'alert-type'=>'error'
                    );
                    return redirect()->back()->with($notification);
                }
                // end

        $this->validate($request,[
            'department'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->department){
            $oldImage=$banner->department;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }
        $image=$request->department;
        $extention=$image->getClientOriginalExtension();
        $name= 'department-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(1280,315)
                ->save('public/'.$image_path);

        BannerImage::where('id',$banner->id)->update([
            'department'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);

    }
    public function testimonial(Request $request){

                // project demo mode check
                if(env('PROJECT_MODE')==0){
                    $notification=array(
                        'messege'=>env('NOTIFY_TEXT'),
                        'alert-type'=>'error'
                    );
                    return redirect()->back()->with($notification);
                }
                // end


        $this->validate($request,[
            'testimonial'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->testimonial){
            $oldImage=$banner->testimonial;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }
        $image=$request->testimonial;
        $extention=$image->getClientOriginalExtension();
        $name= 'testimonial-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(1280,315)
                ->save('public/'.$image_path);

        BannerImage::where('id',$banner->id)->update([
            'testimonial'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);

    }
    public function faq(Request $request){


                // project demo mode check
                if(env('PROJECT_MODE')==0){
                    $notification=array(
                        'messege'=>env('NOTIFY_TEXT'),
                        'alert-type'=>'error'
                    );
                    return redirect()->back()->with($notification);
                }
                // end


        $this->validate($request,[
            'faq'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->faq){
            $oldImage=$banner->faq;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }
        $image=$request->faq;
        $extention=$image->getClientOriginalExtension();
        $name= 'faq-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(1280,315)
                ->save('public/'.$image_path);

        BannerImage::where('id',$banner->id)->update([
            'faq'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);

    }
    public function contact(Request $request){

                // project demo mode check
                if(env('PROJECT_MODE')==0){
                    $notification=array(
                        'messege'=>env('NOTIFY_TEXT'),
                        'alert-type'=>'error'
                    );
                    return redirect()->back()->with($notification);
                }
                // end

        $this->validate($request,[
            'contact'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->contact){
            $oldImage=$banner->contact;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }
        $image=$request->contact;
        $extention=$image->getClientOriginalExtension();
        $name= 'contact-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(1280,315)
                ->save('public/'.$image_path);
        BannerImage::where('id',$banner->id)->update([
            'contact'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }

    public function profile(Request $request){

                // project demo mode check
                if(env('PROJECT_MODE')==0){
                    $notification=array(
                        'messege'=>env('NOTIFY_TEXT'),
                        'alert-type'=>'error'
                    );
                    return redirect()->back()->with($notification);
                }
                // end


        $this->validate($request,[
            'profile'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->profile){
            $oldImage=$banner->profile;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }
        $image=$request->profile;
        $extention=$image->getClientOriginalExtension();
        $name= 'profile-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(1280,315)
                ->save('public/'.$image_path);
        BannerImage::where('id',$banner->id)->update([
            'profile'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }

    public function login(Request $request){


                // project demo mode check
                if(env('PROJECT_MODE')==0){
                    $notification=array(
                        'messege'=>env('NOTIFY_TEXT'),
                        'alert-type'=>'error'
                    );
                    return redirect()->back()->with($notification);
                }
                // end

        $this->validate($request,[
            'login'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->login){
            $oldImage=$banner->login;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }
        $image=$request->login;
        $extention=$image->getClientOriginalExtension();
        $name= 'login-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(1280,315)
                ->save('public/'.$image_path);
        BannerImage::where('id',$banner->id)->update([
            'login'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }

    public function payment(Request $request){

                // project demo mode check
                if(env('PROJECT_MODE')==0){
                    $notification=array(
                        'messege'=>env('NOTIFY_TEXT'),
                        'alert-type'=>'error'
                    );
                    return redirect()->back()->with($notification);
                }
                // end

        $this->validate($request,[
            'payment'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->payment){
            $oldImage=$banner->payment;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }
        $image=$request->payment;
        $extention=$image->getClientOriginalExtension();
        $name= 'payment-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(1280,315)
                ->save('public/'.$image_path);
        BannerImage::where('id',$banner->id)->update([
            'payment'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }

    public function overview(Request $request){

                // project demo mode check
                if(env('PROJECT_MODE')==0){
                    $notification=array(
                        'messege'=>env('NOTIFY_TEXT'),
                        'alert-type'=>'error'
                    );
                    return redirect()->back()->with($notification);
                }
                // end

        $this->validate($request,[
            'overview'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->overview){
            $oldImage=$banner->overview;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }
        $image=$request->overview;
        $extention=$image->getClientOriginalExtension();
        $name= 'overview-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->save('public/'.$image_path);
        BannerImage::where('id',$banner->id)->update([
            'overview'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }
    public function custom_page(Request $request){

                // project demo mode check
                if(env('PROJECT_MODE')==0){
                    $notification=array(
                        'messege'=>env('NOTIFY_TEXT'),
                        'alert-type'=>'error'
                    );
                    return redirect()->back()->with($notification);
                }
                // end

        $this->validate($request,[
            'custom_page'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->custom_page){
            $oldImage=$banner->custom_page;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }
        $image=$request->custom_page;
        $extention=$image->getClientOriginalExtension();
        $name= 'custom_page-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(1280,315)
                ->save('public/'.$image_path);
        BannerImage::where('id',$banner->id)->update([
            'custom_page'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }
    public function blog(Request $request){

                // project demo mode check
                if(env('PROJECT_MODE')==0){
                    $notification=array(
                        'messege'=>env('NOTIFY_TEXT'),
                        'alert-type'=>'error'
                    );
                    return redirect()->back()->with($notification);
                }
                // end

        $this->validate($request,[
            'blog'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->blog){
            $oldImage=$banner->blog;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }
        $image=$request->blog;
        $extention=$image->getClientOriginalExtension();
        $name= 'blog-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(1280,315)
                ->save('public/'.$image_path);
        BannerImage::where('id',$banner->id)->update([
            'blog'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }
    public function privacy_and_policy(Request $request){

                // project demo mode check
                if(env('PROJECT_MODE')==0){
                    $notification=array(
                        'messege'=>env('NOTIFY_TEXT'),
                        'alert-type'=>'error'
                    );
                    return redirect()->back()->with($notification);
                }
                // end


        $this->validate($request,[
            'privacy_and_policy'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->privacy_and_policy){
            $oldImage=$banner->privacy_and_policy;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }
        $image=$request->privacy_and_policy;
        $extention=$image->getClientOriginalExtension();
        $name= 'privacy_and_policy-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(1280,315)
                ->save('public/'.$image_path);
        BannerImage::where('id',$banner->id)->update([
            'privacy_and_policy'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }
    public function terms_and_condition(Request $request){


                // project demo mode check
                if(env('PROJECT_MODE')==0){
                    $notification=array(
                        'messege'=>env('NOTIFY_TEXT'),
                        'alert-type'=>'error'
                    );
                    return redirect()->back()->with($notification);
                }
                // end


        $this->validate($request,[
            'terms_and_condition'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->terms_and_condition){
            $oldImage=$banner->terms_and_condition;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }
        $image=$request->terms_and_condition;
        $extention=$image->getClientOriginalExtension();
        $name= 'terms_and_condition-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(1280,315)
                ->save('public/'.$image_path);
        BannerImage::where('id',$banner->id)->update([
            'terms_and_condition'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }


    public function admin_login(Request $request){

                // project demo mode check
                if(env('PROJECT_MODE')==0){
                    $notification=array(
                        'messege'=>env('NOTIFY_TEXT'),
                        'alert-type'=>'error'
                    );
                    return redirect()->back()->with($notification);
                }
                // end


        $this->validate($request,[
            'admin_login'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->admin_login){
            $oldImage=$banner->admin_login;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }
        $image=$request->admin_login;
        $extention=$image->getClientOriginalExtension();
        $name= 'admin_login-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(464,464)
                ->save('public/'.$image_path);
        BannerImage::where('id',$banner->id)->update([
            'admin_login'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }
    public function doctor_login(Request $request){


                // project demo mode check
                if(env('PROJECT_MODE')==0){
                    $notification=array(
                        'messege'=>env('NOTIFY_TEXT'),
                        'alert-type'=>'error'
                    );
                    return redirect()->back()->with($notification);
                }
                // end

        $this->validate($request,[
            'doctor_login'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->doctor_login){
            $oldImage=$banner->doctor_login;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }
        $image=$request->doctor_login;
        $extention=$image->getClientOriginalExtension();
        $name= 'doctor_login-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(464,464)
                ->save('public/'.$image_path);
        BannerImage::where('id',$banner->id)->update([
            'doctor_login'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }


    public function defaultProfile(Request $request){


                // project demo mode check
                if(env('PROJECT_MODE')==0){
                    $notification=array(
                        'messege'=>env('NOTIFY_TEXT'),
                        'alert-type'=>'error'
                    );
                    return redirect()->back()->with($notification);
                }
                // end

        $this->validate($request,[
            'default_profile'=>'required'
        ]);
        $banner=BannerImage::first();
        if($banner->default_profile){
            $oldImage=$banner->default_profile;
            if(File::exists('public/'.$oldImage))unlink('public/'.$oldImage);
        }

        $image=$request->default_profile;
        $extention=$image->getClientOriginalExtension();
        $name= 'default_profile-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(80,80)
                ->save('public/'.$image_path);
        BannerImage::where('id',$banner->id)->update([
            'default_profile'=>$image_path,
        ]);
        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }

    public function loginImageIndex(){
        $banner=BannerImage::first();
        return view('admin.banner-image.login.index',compact('banner'));
    }

    public function profileImageIndex(){
        $banner=BannerImage::first();
        return view('admin.banner-image.profile.index',compact('banner'));
    }













}
