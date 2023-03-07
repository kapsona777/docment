<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Testimonial;
use Illuminate\Http\Request;
use Image;
use File;
class TestimonialController extends Controller
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
        $testimonials=Testimonial::all();
        return view('admin.testimonial.index',compact('testimonials'));
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
            'name'=>'required',
            'designation'=>'required',
            'image'=>'required',
            'description'=>'required',
            'status'=>'required',
            'show_homepage'=>'required',
        ]);
        $image=$request->image;
        $extention=$image->getClientOriginalExtension();
        $image_name= 'testimonial-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;

        // for small image
        $image_name='uploads/custom-images/'.$image_name;
        Image::make($image)
                ->resize(80,80)
                ->save('public/'.$image_name);
        Testimonial::create([
            'name'=>$request->name,
            'designation'=>$request->designation,
            'image'=>$image_name,
            'description'=>$request->description,
            'status'=>$request->status,
            'show_homepage'=>$request->show_homepage,
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
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {

         // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'name'=>'required',
            'designation'=>'required',
            'description'=>'required',
            'status'=>'required',
            'show_homepage'=>'required',
        ]);

        if($request->file('image')){
            $old_image=$testimonial->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $image_name= 'testimonial-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;

            // for small image
            $image_name='uploads/custom-images/'.$image_name;
            Image::make($image)
                ->resize(80,80)
                ->save('public/'.$image_name);

            $testimonial->image=$image_name;
            if(File::exists('public/'.$old_image))unlink('public/'.$old_image);
        }

        $testimonial->name=$request->name;
        $testimonial->designation=$request->designation;
        $testimonial->status=$request->status;
        $testimonial->show_homepage=$request->show_homepage;
        $testimonial->save();

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {

         // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $image=$testimonial->image;
        $testimonial->delete();
        if(File::exists('public/'.$image))unlink('public/'.$image);
        $notification=array(
            'messege'=>'Deleted Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }

    public function changeStatus($id){
        $testimonial=Testimonial::find($id);
        if($testimonial->status==1){
            $testimonial->status=0;
            $message="In-active Successfully";
        }else{
            $testimonial->status=1;
            $message="Active Successfully";
        }
        $testimonial->save();
        return response()->json($message);

    }
}
