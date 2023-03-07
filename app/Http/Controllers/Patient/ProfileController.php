<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Order;
use App\Appointment;
use App\Setting;
use App\BannerImage;
use Hash;
use Image;
use File;
use App\ManageText;
use App\Navigation;
use App\ValidationText;
use App\NotificationText;
use App\ContactInformation;

class ProfileController extends Controller
{
    protected $banner;
    public function __construct()
    {

        $this->middleware('auth:web');
        $this->banner=BannerImage::first();
    }
    public function dashboard(){
        $user=Auth::user();
        $appointments=Appointment::where('user_id',$user->id)->get();
        $orders=Order::where('user_id',$user->id)->get();
        $banner=$this->banner;
        $navigation=Navigation::first();
        $text=ManageText::first();
        return view('patient.profile.dashboard',compact('user','appointments','orders','banner','navigation','text'));
    }

    public function account(){
        $user=Auth::user();
        $banner=$this->banner;
        $navigation=Navigation::first();
        $text=ManageText::first();
        return view('patient.profile.account',compact('user','banner','navigation','text'));
    }

    public function appointments(){
        $user=Auth::user();
        $currency=Setting::first();
        $appointments=Appointment::where('user_id',$user->id)->orderBy('id','desc')->paginate(10);
        $banner=$this->banner;
        $navigation=Navigation::first();
        $text=ManageText::first();
        return view('patient.profile.appointment',compact('user','appointments','currency','banner','navigation','text'));
    }

    public function showAppointment($id){
        $appointment=Appointment::find($id);
        $user=Auth::user();
        $banner=$this->banner;
        $navigation=Navigation::first();
        $text=ManageText::first();
        $currency=Setting::first();
        $setting=Setting::first();
        $contact=ContactInformation::first();
        return view('patient.profile.show-appointment',compact('user','appointment','banner','navigation','text','currency','setting','contact'));
    }

    public function orders(){
        $user=Auth::user();
        $orders=Order::where('user_id',$user->id)->orderBy('id','desc')->paginate(10);
        $currency=Setting::first();
        $banner=$this->banner;
        $navigation=Navigation::first();
        $text=ManageText::first();
        return view('patient.profile.order',compact('user','orders','currency','banner','navigation','text'));
    }

    public function updateProfile(Request $request) {

            // project demo mode check
    if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
    }
    // end

        $errors=ValidationText::first();

        $rules = [
            'name'=>'required',
            'email'=>'required|unique:users,email,'.Auth::user()->id,
            'phone'=>'required',
            'age'=>'required',
            'occupation'=>'required',
            'gender'=>'required',
            'address'=>'required',
            'country'=>'required',
            'city'=>'required',
        ];

        $customMessages = [
            'name.required' => $errors->name,
            'email.required' => $errors->email,
            'email.email' => $errors->valid_email,
            'email.unique' => $errors->unique_email,
            'phone.required' => $errors->phone,
            'age.required' => $errors->age,
            'occupation.required' => $errors->occupation,
            'gender.required' => $errors->gender,
            'address.required' => $errors->address,
            'country.required' => $errors->country,
            'city.required' => $errors->city
        ];

        $this->validate($request, $rules, $customMessages);



        $current_user=Auth::user();
        $image_name=$current_user->image;

        // inset user profile image
        if($request->file('image')){
            $user_image=$request->image;
            $extention=$user_image->getClientOriginalExtension();
            $image_name= $request->name.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/custom-images/'.$image_name;
            Image::make($user_image)
                    ->resize(255,255)
                    ->save('public/'.$image_name);
            $old_image=User::where('id',Auth::user()->id)->first();
            if($old_image->image)
            {
                if(File::exists('public/'.$old_image->image)) unlink('public/'.$old_image->image);
            }
        }

        User::where('id',Auth::user()->id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'guardian_name'=>$request->guardian_name,
            'guardian_phone'=>$request->guardian_phone,
            'age'=>$request->age,
            'occupation'=>$request->occupation,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'country'=>$request->country,
            'city'=>$request->city,
            'image'=>$image_name,
            'date_of_birth'=>$request->date_of_birth,
            'weight'=>$request->weight,
            'height'=>$request->height,
            'health_insurance_number'=>$request->health_insurance_number,
            'health_card_number'=>$request->health_card_number,
            'health_card_provider'=>$request->health_card_provider,
            'blood_group'=>$request->blood_group,
            'disabilities'=>$request->disabilities,
            'ready_for_appointment'=>1
        ]);

        $notify=NotificationText::first();
        $notification=array(
            'messege'=>$notify->account_update,
            'alert-type'=>'success'
        );
        return back()->with($notification);


    }

    public function changePassword(){
        $user=Auth::user();
        $banner=$this->banner;
        $navigation=Navigation::first();
        $text=ManageText::first();
        return view('patient.profile.change-password',compact('user','banner','navigation','text'));
    }
    public function storePassword(Request $request){

            // project demo mode check
    if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
    }
    // end

        $errors=ValidationText::first();
        $rules = [
            'password'=>'required|confirmed|min:6',
        ];

        $customMessages = [

            'password.required' => $errors->password,
            'password.confirmed' => $errors->confirm_password,
            'password.min' => $errors->minimum_password,
        ];

        $this->validate($request, $rules, $customMessages);

        $user=Auth::user();
        $user->password=Hash::make($request->password);
        $user->save();
        $notify=NotificationText::first();
        $notification=array(
            'messege'=>$notify->password_change,
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }


}
