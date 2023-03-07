<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PaymentAccount;
use Illuminate\Http\Request;

class PaymentAccountController extends Controller
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
    {   $paymentAccount=PaymentAccount::first();
        if($paymentAccount){
            return view('admin.payment-account.edit',compact('paymentAccount'));
        }else{
            return view('admin.payment-account.create');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'account_mode'=>'required',
            'paypal_client_id'=>'required',
            'paypal_secret'=>'required',
            'stripe_key'=>'required',
            'stripe_secret'=>'required',
            'bank_account'=>'required'
        ]);

        $paymentAccount=new PaymentAccount();
        $paymentAccount->account_mode=$request->account_mode;
        $paymentAccount->paypal_client_id=$request->paypal_client_id;
        $paymentAccount->paypal_secret=$request->paypal_secret;
        $paymentAccount->stripe_key=$request->stripe_key;
        $paymentAccount->stripe_secret=$request->stripe_secret;
        $paymentAccount->bank_account=$request->bank_account;
        $paymentAccount->save();
        $notification=array(
            'messege'=>'Inserted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.payment-account.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentAccount  $paymentAccount
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentAccount $paymentAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentAccount  $paymentAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentAccount $paymentAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentAccount  $paymentAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentAccount $paymentAccount)
    {


            // project demo mode check
            if(env('PROJECT_MODE')==0){
                $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
                return redirect()->back()->with($notification);
            }
            // end

        $this->validate($request,[
            'account_mode'=>'required',
            'paypal_client_id'=>'required',
            'paypal_secret'=>'required',
            'stripe_key'=>'required',
            'stripe_secret'=>'required',
            'bank_account'=>'required'
        ]);

        $paymentAccount->account_mode=$request->account_mode;
        $paymentAccount->paypal_client_id=$request->paypal_client_id;
        $paymentAccount->paypal_secret=$request->paypal_secret;
        $paymentAccount->stripe_key=$request->stripe_key;
        $paymentAccount->stripe_secret=$request->stripe_secret;
        $paymentAccount->bank_account=$request->bank_account;
        $paymentAccount->save();
        $notification=array(
            'messege'=>'Update Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.payment-account.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentAccount  $paymentAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentAccount $paymentAccount)
    {
        //
    }
}
