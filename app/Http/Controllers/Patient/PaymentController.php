<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use Session;
use Stripe;
use App\Day;
use App\Schedule;
use App\Doctor;
use App\Department;
use App\Appointment;
use App\PaymentAccount;
use Auth;
use App\Order;
use Str;
use App\Setting;
use App\BannerImage;
use App\ManageText;
use App\Navigation;
use App\Mail\OrderConfirmation;
use Mail;
use App\EmailTemplate;
use App\NotificationText;
use App\Helpers\MailHelper;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function payment(){
        $currency=Setting::first();
        $user=Auth::guard('web')->user();
        $notify=NotificationText::first();
        if($user->ready_for_appointment==1){
            $appointments=Cart::content();
            $stripe=PaymentAccount::first();
            $banner=BannerImage::first();
            $navigation=Navigation::first();
            $text=ManageText::first();
            return view('patient.profile.payment',compact('appointments','stripe','currency','banner','navigation','text'));
        }else{
            $notification=array(
                'messege'=>$notify->fill_up_profile,
                'alert-type'=>'error'
            );
            return redirect()->route('patient.account')->with($notification);
        };

    }


    public function stripePayment(Request $request){
            // project demo mode check
    if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
    }
    // end

        $user=Auth::guard('web')->user();
        $stripe=PaymentAccount::first();
        $currency=Setting::first();
        Stripe\Stripe::setApiKey($stripe->stripe_secret);
        $result=Stripe\Charge::create ([
                "amount" => Cart::pricetotal() * 100,
                "currency" => $currency->currency_name,
                "source" => $request->stripeToken,
                "description" => "Doctor appointment"
        ]);

        // insert order
        $order= Order::create([
            'user_id'=>$user->id,
            'order_id'=>'#'.date('Yms').rand(9,99),
            'total_payment'=>Cart::pricetotal(),
            'appointment_qty'=>Cart::count(),
            'payment_method'=>'Stripe',
            'payment_status'=>1,
            'last4'=>substr($request->card_digit,-4),
            'payment_transaction_id'=>$result->balance_transaction
        ]);
        $order_details="";
        foreach(Cart::content() as $item){
            Appointment::create([
                'order_id'=>$order->id,
                'doctor_id'=>$item->options->doctor_id,
                'user_id'=>$user->id,
                'day_id'=>$item->options->day_id,
                'schedule_id'=>$item->options->schedule_id,
                'date'=>$item->options->date,
                'appointment_fee'=>$item->price,
                'payment_status'=>1,
                'payment_transaction_id'=>$result->balance_transaction,
                'payment_method'=>'Stripe',

            ]);

            $doctor=Doctor::find($item->options->doctor_id);
            $order_details.='Doctor: '. $doctor->name. '<br>';
            $order_details.='Phone: '. $doctor->phone .'<br>';
            $order_details.='Schedule: '.$item->options->time .'<br>';
            $order_details.='Date: '.$currency->currency_icon.$item->price .'<br>';
        }

        Cart::destroy();

         // send email
         $template=EmailTemplate::where('id',6)->first();
         $message=$template->description;
         $subject=$template->subject;
         $message=str_replace('{{patient_name}}',$user->name,$message);
         $message=str_replace('{{orderId}}', $order->order_id ,$message);
         $message=str_replace('{{payment_method}}','Stripe',$message);
         $total_amount=$currency->currency_icon. $order->total_payment;
         $message=str_replace('{{amount}}',$total_amount,$message);
         $message=str_replace('{{order_details}}',$order_details,$message);
         MailHelper::setMailConfig();
         Mail::to($user->email)->send(new OrderConfirmation($message,$subject));

         $notify=NotificationText::first();
        $notification=array(
            'messege'=>$notify->payment_successfull,
            'alert-type'=>'success'
        );

        return redirect()->route('patient.order')->with($notification);
    }
    public function bankPayment(Request $request){

            // project demo mode check
    if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
    }
    // end

        $this->validate($request,[
            'description'=>'required'
        ]);

        $currency=Setting::first();
        $user=Auth::guard('web')->user();

        // insert order
        $order= Order::create([
            'user_id'=>$user->id,
            'order_id'=>'#'.date('Yms').rand(9,99),
            'total_payment'=>Cart::pricetotal(),
            'appointment_qty'=>Cart::count(),
            'payment_method'=>'Bank Transfer',
            'payment_status'=>0,
            'payment_transaction_id'=>null,
            'payment_description'=>$request->description
        ]);

        $order_details="";
        foreach(Cart::content() as $item){
            Appointment::create([
                'order_id'=>$order->id,
                'doctor_id'=>$item->options->doctor_id,
                'user_id'=>$user->id,
                'day_id'=>$item->options->day_id,
                'schedule_id'=>$item->options->schedule_id,
                'date'=>$item->options->date,
                'appointment_fee'=>$item->price,
                'payment_status'=>0,
                'payment_transaction_id'=>null,
                'payment_method'=>'Bank Transfer',
                'payment_description'=>$request->description,
            ]);

            $doctor=Doctor::find($item->options->doctor_id);
            $order_details.='Doctor: '. $doctor->name. '<br>';
            $order_details.='Phone: '. $doctor->phone .'<br>';
            $order_details.='Schedule: '.$item->options->time .'<br>';
            $order_details.='Date: '.$currency->currency_icon.$item->price .'<br>';

        }

        Cart::destroy();

        // send email
        $template=EmailTemplate::where('id',6)->first();
        $message=$template->description;
        $subject=$template->subject;
        $message=str_replace('{{patient_name}}',$user->name,$message);
        $message=str_replace('{{orderId}}', $order->order_id ,$message);
        $message=str_replace('{{payment_method}}','Bank Transfer',$message);
        $total_amount=$currency->currency_icon. $order->total_payment;
        $message=str_replace('{{amount}}',$total_amount,$message);
        $message=str_replace('{{order_details}}',$order_details,$message);
        MailHelper::setMailConfig();
        Mail::to($user->email)->send(new OrderConfirmation($message,$subject));

        $notify=NotificationText::first();
        $notification=array(
            'messege'=>$notify->payment_successfull,
            'alert-type'=>'success'
        );

        return redirect()->route('patient.order')->with($notification);


    }
}
