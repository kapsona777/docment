<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
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
        $medicines=Medicine::all();
        return view('admin.medicine.index',compact('medicines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.medicine.create');
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
            "name"    => "required|array|min:1",
            "name.*"  => "required|string|distinct|min:1",
        ]);

        foreach($request->name as $row){
            Medicine::create([
                'name'=>$row,
                'status'=>1
            ]);
        }

        $notification=array(
            'messege'=>'Inserted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.medicine.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicine $medicine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicine $medicine)
    {

         // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            "name"    => "required",
            "status"    => "required"
        ]);

        $medicine->name=$request->name;
        $medicine->status=$request->status;
        $medicine->save();

        $notification=array(
            'messege'=>'Update Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.medicine.index')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {

         // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $medicine->delete();
        $notification=array(
            'messege'=>'Deleted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.medicine.index')->with($notification);
    }

    // manage blog status
    public function changeStatus($id){
        $medicine=Medicine::find($id);
        if($medicine->status==1){
            $medicine->status=0;
            $message="In-active Successfully";
        }else{
            $medicine->status=1;
            $message="Active Successfully";
        }
        $medicine->save();
        return response()->json($message);

    }
}
