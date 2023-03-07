<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Video;
use App\Department;
use Illuminate\Http\Request;

class DepartmentVideoController extends Controller
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
        $videos=Video::where('video_category',1)->get();
        $departments=Department::all();
        return view('admin.department.video.index',compact('videos','departments'));
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
            'name'=>'required',
            "link"    => "required|array|min:1",
            "link.*"  => "required|string|distinct|min:1",
        ]);

        foreach($request->link as $item){
            Video::create([
                'video_category'=>1,
                'department_id'=>$request->name,
                'link'=>$item,
            ]);
        }

        $notification=array(
            'messege'=>'Inserted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.department-video.index')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
            'name'=>'required',
            "link"    => "required",
            'status'=>'required'
        ]);

        Video::where('id',$id)->update([
            'department_id'=>$request->name,
            'link'=>$request->link,
            'status'=>$request->status
        ]);

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.department-video.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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
        Video::destroy($id);
        $notification=array(
            'messege'=>'Deleted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.department-video.index')->with($notification);
    }

    public function changeStatus($id){
        $video=Video::find($id);
        if($video->status==1){
            $video->status=0;
            $message="In-active Successfully";
        }else{
            $video->status=1;
            $message="Active Successfully";
        }
        $video->save();
        return response()->json($message);

    }
}
