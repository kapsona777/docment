<?php

namespace App\Http\Controllers\Admin;

use App\Feature;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;
class FeatureController extends Controller
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
        $features=Feature::all();
        return view('admin.feature.index',compact('features'));
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
            'title'=>'required|unique:features',
            'background_image'=>'required',
            'logo'=>'required',
            'description'=>'required',
            'status'=>'required',
        ]);

        // save image
        $background_image=$request->background_image;
        $extention=$background_image->getClientOriginalExtension();
        $name= 'feature-bg-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/custom-images/'.$name;
        Image::make($background_image)
                ->save('public/'.$image_path);
        Feature::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'background_image'=>$image_path,
            'logo'=>$request->logo,
            'status'=>$request->status
        ]);

        $notification=array(
            'messege'=>'Created Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.feature.index')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function show(Feature $feature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function edit(Feature $feature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feature $feature)
    {

               // project demo mode check
               if(env('PROJECT_MODE')==0){
                $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
                return redirect()->back()->with($notification);
            }
            // end

        $this->validate($request,[
            'title'=>'required|unique:features,title,'.$feature->id,
            'logo'=>'required',
            'description'=>'required',
            'status'=>'required',
        ]);


        if($request->file('background_image')){
             // save image
            $old_image=$feature->background_image;
            $background_image=$request->background_image;
            $extention=$background_image->getClientOriginalExtension();
            $name= 'featur-bg-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/custom-images/'.$name;
            Image::make($background_image)
                    ->save('public/'.$image_path);
            $feature->background_image=$image_path;
            if(File::exists('public/'.$old_image))unlink('public/'.$old_image);

        }

        // insert database
        $feature->title=$request->title;
        $feature->description=$request->description;
        $feature->logo=$request->logo;
        $feature->status=$request->status;
        $feature->save();

        $notification=array(
            'messege'=>'updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.feature.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature $feature)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
    }
    // end

        $old_image=$feature->background_image;
        $feature->delete();
        if(File::exists('public/'.$old_image))unlink('public/'.$old_image);
        $notification=array(
            'messege'=>'Deleted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.feature.index')->with($notification);

    }


    public function changeStatus($id){
        $feature=Feature::find($id);
        if($feature->status==1){
            $feature->status=0;
            $message="In-active Successfully";
        }else{
            $feature->status=1;
            $message="Active Successfully";
        }
        $feature->save();
        return response()->json($message);

    }
}
