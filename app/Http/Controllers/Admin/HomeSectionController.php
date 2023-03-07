<?php

namespace App\Http\Controllers\Admin;

use App\HomeSection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeSectionController extends Controller
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
        $sections=HomeSection::all();
        return view('admin.home-section.index',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HomeSection  $homeSection
     * @return \Illuminate\Http\Response
     */
    public function show(HomeSection $homeSection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HomeSection  $homeSection
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeSection $homeSection)
    {
        return view('admin.home-section.edit',compact('homeSection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HomeSection  $homeSection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeSection $homeSection)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $this->validate($request,[
            'first_header'=>$request->section_type==1 ? 'nullable' : 'required',
            'second_header'=>$request->section_type==1 ? 'nullable' : 'required',
            'description'=>$request->section_type==1 ? 'nullable' : 'required',
            'show_homepage'=>'required',
            'content_quantity'=>$request->section_type==2 ? 'nullable' : 'required',
        ]);

        $homeSection->first_header=$request->first_header;
        $homeSection->second_header=$request->second_header;
        $homeSection->description=$request->description;
        $homeSection->content_quantity=$request->content_quantity;
        $homeSection->show_homepage=$request->show_homepage;
        $homeSection->save();

        $notification=array(
            'messege'=>'Update Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.home-section.index')->with($notification);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HomeSection  $homeSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeSection $homeSection)
    {

    }


    public function changeStatus($id){
        $section=HomeSection::find($id);
        if($section->show_homepage==1){
            $section->show_homepage=0;
            $message="In-active Successfully";
        }else{
            $section->show_homepage=1;
            $message="Active Successfully";
        }
        $section->save();
        return response()->json($message);

    }
}
