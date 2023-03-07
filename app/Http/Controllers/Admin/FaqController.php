<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use App\FaqCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqController extends Controller
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
    public function index($slug)
    {
        $category=FaqCategory::where('slug',$slug)->first();
        $faqs=Faq::where('category_id',$category->id)->get();
        return view('admin.faq.category.faq.index',compact('faqs','category'));
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
            'question'=>'required|unique:faqs',
            'answer'=>'required',
            'status'=>'required',
        ]);

        Faq::create([
            'category_id'=>$request->category_id,
            'question'=>$request->question,
            'answer'=>$request->answer,
            'status'=>$request->status,
        ]);

        $notification=array(
            'messege'=>'Created Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
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
            'question'=>'required|unique:faqs,question,'.$faq->id,
            'answer'=>'required',
            'status'=>'required',
        ]);

        $faq->question=$request->question;
        $faq->answer=$request->answer;
        $faq->status=$request->status;
        $faq->save();
        $notification=array(
            'messege'=>'updated Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $faq->delete();
        $notification=array(
            'messege'=>'Deleted Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }

    // change category status
    public function changeStatus($id){
        $faq=Faq::find($id);
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
