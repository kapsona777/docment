<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ManageText;

class TextController extends Controller
{
    public function index(){
        $text=ManageText::first();
        return view('admin.manage-text.index',compact('text'));
    }

    public function update(Request $request){

         // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $this->validate($request,[
            'appointment_modal_title'=>'required',
            'appointment_submit_btn'=>'required',
            'appointment_close_btn'=>'required',
            'doctor_search_btn'=>'required',
            'service_learn_more'=>'required',
            'service_btn'=>'required',
            'department_btn'=>'required',
            'subscribe_btn'=>'required',
            'email_address'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'footer_about_us'=>'required',
            'footer_importent_link'=>'required',
            'footer_recent_post'=>'required',
            'department_read_more_btn'=>'required',
            'department_doctor'=>'required',
            'frequently_ask_questions'=>'required',
            'related_video'=>'required',
            'blog_learn_more'=>'required',
            'blog_category'=>'required',
            'blog_recent_post'=>'required',
            'comments'=>'required',
            'get_comment'=>'required',
            'comment_submit_btn'=>'required',
            'send_msg_btn'=>'required',
            'appointment_fee'=>'required',
            'doctor_info'=>'required',
            'doctor_working_hours'=>'required',
            'doctor_address'=>'required',
            'doctor_education'=>'required',
            'doctor_experience'=>'required',
            'doctor_qualification'=>'required',
            'doctor_book_appointment'=>'required',
            'doctor_book_appointment_title'=>'required',
            'login_btn'=>'required',
            'login_text'=>'required',
            'register_btn'=>'required',
            'register_text'=>'required',
            'forget_pass_btn'=>'required',
            'forget_pass_text'=>'required',
            'reset_pass_btn'=>'required',
            'appointment_list'=>'required',
            'pay_now'=>'required',
            'stripe'=>'required',
            'stripe_btn'=>'required',
            'stripe_card_error'=>'required',
            'paypal'=>'required',
            'paypal_btn'=>'required',
            'bank_transfer'=>'required',
            'bank_transfer_btn'=>'required',
            'bank_account_info'=>'required',
            'transaction_info'=>'required',
            'total_appointment'=>'required',
            'pending_appointment'=>'required',
            'dashboard'=>'required',
            'message'=>'required',
            'send_message_btn'=>'required',
            'account_info'=>'required',
            'order_list'=>'required',
            'change_password'=>'required',
            'logout'=>'required',
            'update_profile_btn'=>'required',
            'patient_id'=>'required',
            'order_info'=>'required',
            'appointment_history'=>'required',
            'billing_info'=>'required',
            'pyshical_info'=>'required',
            'prescribe'=>'required',
            'advice'=>'required',
            'quick_contact'=>'required',
            'doctor_not_found'=>'required',
            'post_not_found'=>'required',
            'schedule_not_found'=>'required',
            'select_department'=>'required',
            'select_doctor'=>'required',
            'select_date'=>'required',
            'select_schedule'=>'required',
            'select_location'=>'required',
            'select_gender'=>'required',
            'male'=>'required',
            'female'=>'required',
            'others'=>'required',
            'admin'=>'required',
            'comment'=>'required',
            'week_day'=>'required',
            'schedule'=>'required',
            'doctor'=>'required',
            'department'=>'required',
            'location'=>'required',
            'date'=>'required',
            'action'=>'required',
            'total'=>'required',
            'card_number'=>'required',
            'cvc'=>'required',
            'expiration_month'=>'required',
            'expiration_year'=>'required',
            'name'=>'required',
            'guardian_name'=>'required',
            'guardian_phone'=>'required',
            'patient_age'=>'required',
            'occupation'=>'required',
            'gender'=>'required',
            'country'=>'required',
            'city'=>'required',
            'photo'=>'required',
            'date_of_birth'=>'required',
            'weight'=>'required',
            'height'=>'required',
            'helth_insurance_number'=>'required',
            'helth_card_number'=>'required',
            'helth_card_provider'=>'required',
            'blood_group'=>'required',
            'disablities'=>'required',
            'Serial_number'=>'required',
            'payment'=>'required',
            'treated'=>'required',
            'order_id'=>'required',
            'payment_method'=>'required',
            'transaction_id'=>'required',
            'description'=>'required',
            'blood_pressure'=>'required',
            'pulse_rate'=>'required',
            'temperature'=>'required',
            'habits'=>'required',
            'problems'=>'required',
            'medicine_type'=>'required',
            'medicine_name'=>'required',
            'dosage'=>'required',
            'day'=>'required',
            'time'=>'required',
            'test_description'=>'required',
            'password'=>'required',
            'confirm_password'=>'required',
            'change_password_btn'=>'required',
            'not_found'=>'required',
            'upcoming_meeting'=>'required',
            'meeting_history'=>'required',
            'duration'=>'required',
            'meeting_id'=>'required',
            'join_link'=>'required',
            'minute'=>'required',
        ]);








        unset($request['_token']);

        $text=ManageText::first();
        ManageText::where('id',$text->id)->update($request->all());
        $notification=array(
            'messege'=>'Update Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }
}
