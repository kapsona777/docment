<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Overview;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $overviews=Overview::all();
        return view('admin.overview.index',compact('overviews'));
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
            'qty'=>'required',
            'icon'=>'required',
        ]);

        $overview=new Overview();
        $overview->name=$request->name;
        $overview->qty=$request->qty;
        $overview->icon=$request->icon;
        $overview->status=$request->status;
        $overview->save();

        $notification=array(
            'messege'=>'Inserted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.overview.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Overview  $overview
     * @return \Illuminate\Http\Response
     */
    public function show(Overview $overview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Overview  $overview
     * @return \Illuminate\Http\Response
     */
    public function edit(Overview $overview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Overview  $overview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Overview $overview)
    {

         // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'name'=>'required',
            'qty'=>'required',
            'icon'=>'required',
        ]);

        $overview->name=$request->name;
        $overview->qty=$request->qty;
        $overview->icon=$request->icon;
        $overview->status=$request->status;
        $overview->save();

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.overview.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Overview  $overview
     * @return \Illuminate\Http\Response
     */
    public function destroy(Overview $overview)
    {

         // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $overview->delete();
        $notification=array(
            'messege'=>'Deleted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.overview.index')->with($notification);
    }

    public function changeStatus($id){
        $overview=Overview::find($id);
        if($overview->status==1){
            $overview->status=0;
            $message="In-active Successfully";
        }else{
            $overview->status=1;
            $message="Active Successfully";
        }
        $overview->save();
        return response()->json($message);

    }
}
