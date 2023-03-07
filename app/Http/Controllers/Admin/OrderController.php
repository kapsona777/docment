<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\CancelOrder;
use App\Appointment;
use App\ContactMessage;
use App\Setting;
use App\Prescribe;
use App\Advice;
class OrderController extends Controller
{
    public function pendingOrder(){
        $orders=Order::where('payment_status',0)->get();
        return view('admin.order.pending',compact('orders'));
    }

    public function showOrder($id){
        $order=Order::with('appointments')->where('id',$id)->first();
        $currency=Setting::first();
        return view('admin.order.show',compact('order','currency'));
    }

    public function allOrder(){
        $orders=Order::all();
        return view('admin.order.all',compact('orders'));
    }

    public function paymentAccept($id){

         // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $order=Order::with('appointments')->where('id',$id)->first();
        $order->payment_status=1;
        $order->save();
        foreach($order->appointments as $appointment){
            $appointment->payment_status=1;
            $appointment->save();
        }
        $notification=array(
            'messege'=>'Payment Acccepted Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }

    public function cancleOrder($id){

         // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $order=Order::with('appointments')->where('id',$id)->first();
        foreach($order->appointments as $appointment){
            $appointment->delete();
            Advice::destroy($appointment->id);
            Prescribe::destroy($appointment->id);
        }
        $order->delete();
        $notification=array(
            'messege'=>'Order Deleted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('admin.pending.order')->with($notification);
    }

    public function cancleOrderPayment(){
        $orders=CancelOrder::all();
        return view('admin.order.cancled-payment',compact('orders'));
    }

    public function viewOrderNotify(){
        Order::where('show_notification',0)->update(['show_notification'=>1]);
        return "success";
    }

    public function viewMessageNotify(){
        ContactMessage::where('show_notification',0)->update(['show_notification'=>1]);
        return "success";
    }
}
