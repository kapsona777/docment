<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service;
use App\ServiceImage;
use Illuminate\Http\Request;
use Image;
use Str;
use File;
class ServiceController extends Controller
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
        $services=Service::all();
        return view('admin.service.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create');
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
            'header'=>'required|unique:services',
            'icon'=>'required',
            'images'=>'required',
            'sort_description'=>'required',
            'long_description'=>'required',
            'status'=>'required',
            'show_homepage'=>'required',
        ]);


        // insert Department
        $service=Service::create([
            'header'=>$request->header,
            'icon'=>$request->icon,
            'slug'=>Str::slug($request->header),
            'seo_title'=>$request->seo_title ? $request->seo_title : 'service seo title',
            'seo_description'=>$request->seo_description ? $request->seo_description : 'service seo description',
            'sort_description'=>$request->sort_description,
            'long_description'=>$request->long_description,
            'status'=>$request->status,
            'show_homepage'=>$request->show_homepage,
        ]);


        // image insert
        foreach($request->images  as $index => $row){
            $ext=$row->getClientOriginalExtension();
            $small_name= 'service-small-'.date('Y-m-d-h-i-s-').rand(999,9999).$index.'.'.$ext;
            $large_name= 'service-large-'.date('Y-m-d-h-i-s-').rand(999,9999).$index.'.'.$ext;


            // for small image
            $small_name='uploads/custom-images/'.$small_name;
            Image::make($row)
                    ->resize(175,116)
                    ->save('public/'.$small_name);


            // large image
            $large_name='uploads/custom-images/'.$large_name;
            Image::make($row)
                    ->resize(730,486)
                    ->save('public/'.$large_name);


            $isInsert=ServiceImage::create([
                'service_id'=>$service->id,
                'small_image'=>$small_name,
                'large_image'=>$large_name
            ]);
        }


        $notification=array(
            'messege'=>'Created Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.service.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('admin.service.edit',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'header'=>'required|unique:services,header,'.$service->id,
            'icon'=>'required',
            'sort_description'=>'required',
            'long_description'=>'required',
            'status'=>'required',
            'show_homepage'=>'required',
        ]);

        // update service
        $service->header=$request->header;
        $service->slug=Str::slug($request->header);
        $service->icon=$request->icon;
        $service->seo_title=$request->seo_title ? $request->seo_title : 'service seo title';
        $service->seo_description=$request->seo_description ? $request->seo_description : 'service seo description';
        $service->sort_description=$request->sort_description;
        $service->long_description=$request->long_description;
        $service->status=$request->status;
        $service->show_homepage=$request->show_homepage;
        $service->save();

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.service.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $oldImages=$service->images;
        $service->delete();
        foreach($oldImages as $img){

            if(File::exists('public/'.$img->small_image))unlink('public/'.$img->small_image);
            if(File::exists('public/'.$img->large_image))unlink('public/'.$img->large_image);
            $img::destroy($img->id);
        }
        $notification=array(
            'messege'=>'Deleted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.service.index')->with($notification);

    }

    // change service status
    public function changeStatus($id){
        $service=Service::find($id);
        if($service->status==1){
            $service->status=0;
            $message="In-active Successfully";
        }else{
            $service->status=1;
            $message="Active Successfully";
        }
        $service->save();
        return response()->json($message);

    }

    // manage services images
    public function images($serviceId){
        $images=ServiceImage::where('service_id',$serviceId)->get();
        return view('admin.service.image',compact('images','serviceId'));
    }

    // delete service image
    public function deleteImage($id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $image=ServiceImage::find($id);
        $small_image=$image->small_image;
        $large_image=$image->large_image;
        ServiceImage::destroy($id);
        if(File::exists('public/'.$small_image))unlink('public/'.$small_image);
        if(File::exists('public/'.$large_image))unlink('public/'.$large_image);
        $notification=array(
            'messege'=>'Image Deleted Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }

    // store images
    public function storeImage(Request $request,$serviceId){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            "image"    => "required|array|min:1",
            "image.*"  => "required|distinct|min:1",
        ]);

        foreach($request->image as $index => $row){
            $extention=$row->getClientOriginalExtension();
            $small_image= 'service-small-'.date('Y-m-d-h-i-s-').rand(999,9999).$index.'.'.$extention;
            $large_image= 'service-large-'.date('Y-m-d-h-i-s-').rand(999,9999).$index.'.'.$extention;

            // for small image
            $small_image='uploads/custom-images/'.$small_image;
            $large_image='uploads/custom-images/'.$large_image;
            Image::make($row)
                    ->resize(175,116)
                    ->save('public/'.$small_image);
            Image::make($row)
                    ->resize(730,486)
                    ->save('public/'.$large_image);
            ServiceImage::create([
                'service_id'=>$serviceId,
                'small_image'=>$small_image,
                'large_image'=>$large_image
            ]);
        }

        $notification=array(
            'messege'=>'Image Inserted Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }
}


