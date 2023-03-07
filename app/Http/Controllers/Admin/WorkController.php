<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Work;
use Illuminate\Http\Request;
use Image;
use File;
class WorkController extends Controller
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
        $work=Work::first();
        if($work){
            return view('admin.work.edit',compact('work'));
        }else{
            return view('admin.work.create');
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
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $this->validate($request,[
            'image'=>'required',
            'video'=>'required',
            'title'=>'required',
            'description'=>'required',
        ]);

        $image=$request->image;
        $extention=$image->getClientOriginalExtension();
        $name= 'work-background-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;

        $image_path='uploads/website-images/'.$name;
        Image::make($image)
                ->resize(645,645)
                ->save('public/'.$image_path);

        Work::create([
            'image'=>$image_path,
            'video'=>$request->video,
            'title'=>$request->title,
            'description'=>$request->description,
        ]);

        $notification=array(
            'messege'=>'Create Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.work.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function show(Work $work)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function edit(Work $work)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Work $work)
    {

         // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'video'=>'required',
            'title'=>'required',
            'description'=>'required',
        ]);

        if($request->file('image')){
            $old_image=$work->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $name= 'work-background-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;

            $image_path='uploads/website-images/'.$name;
            Image::make($image)
                    ->resize(645,645)
                    ->save('public/'.$image_path);

            Work::where('id',$work->id)->update([
                'image'=>$image_path,
                'video'=>$request->video,
                'title'=>$request->title,
                'description'=>$request->description,
            ]);
            if(File::exists('public/'.$old_image))unlink('public/'.$old_image);

        }else{
            Work::where('id',$work->id)->update([
                'video'=>$request->video,
                'title'=>$request->title,
                'description'=>$request->description,
            ]);
        }


        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.work.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        //
    }
}
