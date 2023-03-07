<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ServiceFaq;
use Illuminate\Http\Request;

class ServiceFaqController extends Controller
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
    public function faqByService($id)
    {
        $faqs=ServiceFaq::with('service')->where('service_id',$id)->get();
        return view('admin.faq.service.index',compact('faqs','id'));
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
            'question'=>'required',
            'answer'=>'required',
            'status'=>'required',
        ]);

        ServiceFaq::create([
            'service_id'=>$request->service_id,
            'question'=>$request->question,
            'answer'=>$request->answer,
            'status'=>$request->status,
        ]);

        $notification=array(
            'messege'=>'Created Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.faq.by.service',$request->service_id)->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServiceFaq  $serviceFaq
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceFaq $serviceFaq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServiceFaq  $serviceFaq
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceFaq $serviceFaq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ServiceFaq  $serviceFaq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'question'=>'required',
            'answer'=>'required',
            'status'=>'required',
        ]);

        ServiceFaq::where('id',$id)->update([
            'service_id'=>$request->service_id,
            'question'=>$request->question,
            'answer'=>$request->answer,
            'status'=>$request->status,
        ]);

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.faq.by.service',$request->service_id)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServiceFaq  $serviceFaq
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $service=ServiceFaq::find($id);
        ServiceFaq::destroy($id);
        $notification=array(
            'messege'=>'Deleted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.faq.by.service',$service->service_id)->with($notification);
    }


    public function changeStatus($id){
        $faq=ServiceFaq::find($id);
        if($faq->status==1){
            $faq->status=0;
            $message="In-active Successfully";
        }else{
            $faq->status=1;
            $message="Active Successfully";
        }
        $faq->save();
        return response()->json($message);

    }
}
