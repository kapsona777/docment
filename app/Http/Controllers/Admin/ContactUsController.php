<?php

namespace App\Http\Controllers\Admin;

use App\ContactUs;
use App\ContactMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactUsController extends Controller
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
        $contact=ContactUs::first();
        if($contact){
            return view('admin.contact.contact-us.edit',compact('contact'));
        }else{
            return view('admin.contact.contact-us.create');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return back();
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
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        // end

        $contact=ContactUs::all()->count();
        if($contact==0){
            ContactUs::create([
                'email'=>$request->email,
                'phone'=>$request->phone,
                'facebook'=>$request->facebook,
                'twitter'=>$request->twitter,
                'pinterest'=>$request->pinterest,
                'linkedin'=>$request->linkedin,
                'youtube'=>$request->youtube,
            ]);

            $notification=array(
                'messege'=>'Created Successfully',
                'alert-type'=>'success'
            );

            return redirect()->route('admin.contact-us.index')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Contact Field Already Exist',
                'alert-type'=>'error'
            );

            return redirect()->route('admin.contact-us.index')->with($notification);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function show(ContactUs $contactUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        // end

        ContactUs::where('id',$id)->update([
            'email'=>$request->email,
            'phone'=>$request->phone,
            'facebook'=>$request->facebook,
            'twitter'=>$request->twitter,
            'pinterest'=>$request->pinterest,
            'linkedin'=>$request->linkedin,
            'youtube'=>$request->youtube
        ]);

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.contact-us.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUs $contactUs)
    {
        //
    }


    public function message(){
        $messages=ContactMessage::orderBy('id','desc')->get();
        return view('admin.contact.contact-message.index',compact('messages'));
    }
}
