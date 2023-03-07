<?php

namespace App\Http\Controllers\Admin;

use App\FaqCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
class FaqCategoryController extends Controller
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
        $categories=FaqCategory::all();
        return view('admin.faq.category.index',compact('categories'));
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
            'name'=>'required|unique:faq_categories',
            'status'=>'required'
        ]);
        FaqCategory::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'status'=>$request->status
        ]);

        $notification=array(
            'messege'=>'Created Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.faq-category.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FaqCategory  $faqCategory
     * @return \Illuminate\Http\Response
     */
    public function show(FaqCategory $faqCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FaqCategory  $faqCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(FaqCategory $faqCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FaqCategory  $faqCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FaqCategory $faqCategory)
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
            'name'=>'required|unique:faq_categories,name,'.$faqCategory->id,
            'status'=>'required'
        ]);
        $faqCategory->name=$request->name;
        $faqCategory->slug=Str::slug($request->name);
        $faqCategory->status=$request->status;
        $faqCategory->save();

        $notification=array(
            'messege'=>'Update Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.faq-category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FaqCategory  $faqCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(FaqCategory $faqCategory)
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

        $faqCategory->delete();
        $notification=array(
            'messege'=>'Deleted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.faq-category.index')->with($notification);
    }

    // change category status
    public function changeStatus($id){
        $category=FaqCategory::find($id);
        if($category->status==1){
            $category->status=0;
            $message="In-active Successfully";
        }else{
            $category->status=1;
            $message="Active Successfully";
        }
        $category->save();
        return response()->json($message);

    }
}
