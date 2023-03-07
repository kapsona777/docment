<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MedicineType;
use Illuminate\Http\Request;

class MedicineTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicinetypes=MedicineType::all();
        return view('admin.medicine.medicine-type.index',compact('medicinetypes'));
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
            'type'=>'required|unique:medicine_types',
            'status'=>'required'
        ]);

        $medicineType=new MedicineType();
        $medicineType->type=$request->type;
        $medicineType->status=$request->status;
        $medicineType->save();
        $notification=array(
            'messege'=>'Inserted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.medicine-type.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MedicineType  $medicineType
     * @return \Illuminate\Http\Response
     */
    public function show(MedicineType $medicineType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MedicineType  $medicineType
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicineType $medicineType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MedicineType  $medicineType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicineType $medicineType)
    {

          // project demo mode check
          if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'type'=>'required|unique:medicine_types,type,'.$medicineType->id,
            'status'=>'required'
        ]);
        $medicineType->type=$request->type;
        $medicineType->status=$request->status;
        $medicineType->save();
        $notification=array(
            'messege'=>'Update Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.medicine-type.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MedicineType  $medicineType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicineType $medicineType)
    {

          // project demo mode check
          if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $medicineType->delete();
        $notification=array(
            'messege'=>'Deleted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.medicine-type.index')->with($notification);
    }

    public function changeStatus($id){
        $medicine=MedicineType::find($id);
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
