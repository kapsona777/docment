<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\WorkFaq;
use Illuminate\Http\Request;

class WorkFaqController extends Controller
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
        $faqs=WorkFaq::all();
        return view('admin.work.faq.index',compact('faqs'));
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
            'status'=>'required'
        ]);

        WorkFaq::create([
            'question'=>$request->question,
            'answer'=>$request->answer,
            'status'=>$request->status,
        ]);

        $notification=array(
            'messege'=>'Created Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.work-faq.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkFaq  $workFaq
     * @return \Illuminate\Http\Response
     */
    public function show(WorkFaq $workFaq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkFaq  $workFaq
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkFaq $workFaq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkFaq  $workFaq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkFaq $workFaq)
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
            'status'=>'required'
        ]);

        WorkFaq::where('id',$workFaq->id)->update([
            'question'=>$request->question,
            'answer'=>$request->answer,
            'status'=>$request->status,
        ]);

        $notification=array(
            'messege'=>'Update Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.work-faq.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkFaq  $workFaq
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkFaq $workFaq)
    {

         // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $workFaq->delete();
        $notification=array(
            'messege'=>'Deleted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.work-faq.index')->with($notification);
    }

    public function changeStatus($id){
        $workFaq=WorkFaq::find($id);
        if($workFaq->status==1){
            $workFaq->status=0;
            $message="In-active Successfully";
        }else{
            $workFaq->status=1;
            $message="Active Successfully";
        }
        $workFaq->save();
        return response()->json($message);

    }
}
