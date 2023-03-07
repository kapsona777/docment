<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Image;
use App\DepartmentImage;
use App\Doctor;
use File;
class DepartmentController extends Controller
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
        $departments=Department::with('images')->get();
        $doctors=Doctor::all();
        return view('admin.department.index',compact('departments','doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.department.create');
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
            'name'=>'required|unique:departments',
            'thumbnail_image'=>'required',
            'description'=>'required',
            'status'=>'required',
            'show_homepage'=>'required',
        ]);

        // for feature image
        $thumbnail_image=$request->thumbnail_image->getClientOriginalExtension();
        $thumbnail_image= 'department-feature-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$thumbnail_image;
        $thumbnail_image='uploads/custom-images/'.$thumbnail_image;
        Image::make($request->thumbnail_image)
            ->resize(350,220)
            ->save('public/'.$thumbnail_image);

        // insert Department
        $department=Department::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'description'=>$request->description,
            'seo_title'=>$request->seo_title ? $request->seo_title : 'service seo title',
            'seo_description'=>$request->seo_description ? $request->seo_description : 'service seo description',
            'status'=>$request->status,
            'thumbnail_image'=>$thumbnail_image,
            'show_homepage'=>$request->show_homepage,
        ]);

        $notification=array(
            'messege'=>'Created Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.department.index')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('admin.department.edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {

        if(env('PROJECT_MODE')==0){
            $notification=array(
            'messege'=>env('NOTIFY_TEXT'),
            'alert-type'=>'error'
            );

        return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'name'=>'required|unique:departments,name,'.$department->id,
            'description'=>'required',
            'status'=>'required',
            'show_homepage'=>'required',
        ]);

        if($request->file('thumbnail_image')){
            $old_thumbnail_image=$department->thumbnail_image;
             // for feature image
            $thumbnail_image=$request->thumbnail_image->getClientOriginalExtension();
            $thumbnail_image= 'department-thumbnail-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$thumbnail_image;
            $thumbnail_image='uploads/custom-images/'.$thumbnail_image;
            Image::make($request->thumbnail_image)
                ->resize(350,220)
                ->save('public/'.$thumbnail_image);
            $department->thumbnail_image=$thumbnail_image;
            if(File::exists('public/'.$old_thumbnail_image))unlink('public/'.$old_thumbnail_image);

        }

        $department->name=$request->name;
        $department->slug=Str::slug($request->name);
        $department->description=$request->description;
        $department->seo_title=$request->seo_title ? $request->seo_title : 'department seo title';
        $department->seo_description=$request->seo_description ? $request->seo_description : 'department seo description';
        $department->status=$request->status;
        $department->show_homepage=$request->show_homepage;
        $department->save();

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.department.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {

        if(env('PROJECT_MODE')==0){
            $notification=array(
            'messege'=>env('NOTIFY_TEXT'),
            'alert-type'=>'error'
            );

        return redirect()->back()->with($notification);
        }
        // end


        $oldImages=$department->images;
        $old_feature_image=$department->thumbnail_image;
        $department->delete();
        if(File::exists('public/'.$old_feature_image))unlink('public/'.$old_feature_image);
        foreach($oldImages as $img){
            if(File::exists('public/'.$img->small_image))unlink('public/'.$img->small_image);
            if(File::exists('public/'.$img->large_image))unlink('public/'.$img->large_image);
            $img->destroy($img->id);
        }

        $notification=array(
            'messege'=>'Deleted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.department.index')->with($notification);
    }


    // change department status
    public function changeStatus($id){
        $department=Department::find($id);
        if($department->status==1){
            $department->status=0;
            $message="In-active Successfully";
        }else{
            $department->status=1;
            $message="Active Successfully";
        }
        $department->save();
        return response()->json($message);

    }


    // manage department images
    public function images($departmentId){
        $images=DepartmentImage::where('department_id',$departmentId)->get();
        $department=Department::find($departmentId);
        return view('admin.department.image',compact('images','department'));
    }

    // store feature images
    public function storeImage(Request $request,$departmentId){

        if(env('PROJECT_MODE')==0){
            $notification=array(
            'messege'=>env('NOTIFY_TEXT'),
            'alert-type'=>'error'
            );

        return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            "image"    => "required|array|min:1",
            "image.*"  => "required|distinct|min:1",
        ]);

        foreach($request->image as $index => $row){
            $extention=$row->getClientOriginalExtension();
            $small_image= 'department-small-'.date('Y-m-d-h-i-s-').rand(999,9999).$index.'.'.$extention;
            $large_image= 'department-large-'.date('Y-m-d-h-i-s-').rand(999,9999).$index.'.'.$extention;

            // for small image
            $small_image='uploads/custom-images/'.$small_image;
            $large_image='uploads/custom-images/'.$large_image;
            Image::make($row)
                    ->resize(175,116)
                    ->save('public/'.$small_image);
            Image::make($row)
                    ->resize(730,486)
                    ->save('public/'.$large_image);
            DepartmentImage::create([
                'department_id'=>$departmentId,
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

    // insert department thumbnail
    public function thumbnailImage(Request $request,$departmentId){

        if(env('PROJECT_MODE')==0){
            $notification=array(
            'messege'=>env('NOTIFY_TEXT'),
            'alert-type'=>'error'
            );

        return redirect()->back()->with($notification);
        }
        // end


        if(!$request->file('thumbnail_image')){
            return back()->with(['thumbnail_error'=>'Thumbnail Image is Required']);
        }else{
            $image=$request->thumbnail_image;
            $extention=$image->getClientOriginalExtension();
            $name= 'department-thumbnail-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/custom-images/'.$name;
            Image::make($image)
                    ->resize(350,220)
                    ->save('public/'.$image_path);
            Department::where('id',$departmentId)->update(['thumbnail_image'=>$image_path]);
                // remove old thumbnail from storage
            if(File::exists('public/'.$request->old_thumbnail))unlink('public/'.$request->old_thumbnail);
            $notification=array(
                'messege'=>'Image Added Successfully',
                'alert-type'=>'success'
            );

            return back()->with($notification);

        }
    }

    // delete department thumbnail image
    public function deleteThumbnail($departmentId){

        if(env('PROJECT_MODE')==0){
            $notification=array(
            'messege'=>env('NOTIFY_TEXT'),
            'alert-type'=>'error'
            );

        return redirect()->back()->with($notification);
        }
        // end

        $department=Department::find($departmentId);
        $thumbnail_image=$department->thumbnail_image;
        Department::where('id',$departmentId)->update(['thumbnail_image'=>null]);
        if(File::exists('public/'.$thumbnail_image))unlink('public/'.$thumbnail_image);
            $notification=array(
                'messege'=>'Image Deleted Successfully',
                'alert-type'=>'success'
            );

            return back()->with($notification);
    }

    // delete department image
    public function deleteImage($imageId){

        if(env('PROJECT_MODE')==0){
            $notification=array(
            'messege'=>env('NOTIFY_TEXT'),
            'alert-type'=>'error'
            );

        return redirect()->back()->with($notification);
        }
        // end

        $image=DepartmentImage::find($imageId);
        $small_image=$image->small_image;
        $large_image=$image->large_image;
        DepartmentImage::destroy($imageId);
        if(File::exists('public/'.$small_image))unlink('public/'.$small_image);
        if(File::exists('public/'.$large_image))unlink('public/'.$large_image);
        $notification=array(
            'messege'=>'Image Deleted Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);
    }
}
