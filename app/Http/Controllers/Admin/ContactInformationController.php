<?php

namespace App\Http\Controllers\Admin;

use App\ContactInformation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactInformationController extends Controller
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
        $contact=ContactInformation::first();
        if($contact){
            return view('admin.contact.contact-information.edit',compact('contact'));
        }{
            return view('admin.contact.contact-information.create');
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
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        // end
        $this->validate($request,[
            'header'=>'required',
            'address'=>'required',
            'description'=>'required',
            'about'=>'required',
            'phones'=>'required',
            'emails'=>'required',
            'map_embed_code'=>'required',
            'copyright'=>'required',
        ]);

        ContactInformation::create([
            'header'=>$request->header,
            'address'=>$request->address,
            'description'=>$request->description,
            'about'=>$request->about,
            'phones'=>$request->phones,
            'emails'=>$request->emails,
            'map_embed_code'=>$request->map_embed_code,
            'copyright'=>$request->copyright,
        ]);

        $notification=array(
            'messege'=>'Created Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.contact-information.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactInformation  $contactInformation
     * @return \Illuminate\Http\Response
     */
    public function show(ContactInformation $contactInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactInformation  $contactInformation
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactInformation $contactInformation)
    {
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactInformation  $contactInformation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactInformation $contactInformation)
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


        $this->validate($request,[
            'header'=>'required',
            'address'=>'required',
            'description'=>'required',
            'about'=>'required',
            'phones'=>'required',
            'emails'=>'required',
            'map_embed_code'=>'required',
            'copyright'=>'required',
        ]);

        ContactInformation::where('id',$contactInformation->id)->update([
            'header'=>$request->header,
            'address'=>$request->address,
            'description'=>$request->description,
            'about'=>$request->about,
            'phones'=>$request->phones,
            'emails'=>$request->emails,
            'map_embed_code'=>$request->map_embed_code,
            'copyright'=>$request->copyright,
        ]);

        $notification=array(
            'messege'=>'Update Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.contact-information.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactInformation  $contactInformation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactInformation $contactInformation)
    {
        //
    }
}
