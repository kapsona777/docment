<?php

namespace App\Http\Controllers\Admin;

use App\CustomePage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
class CustomePageController extends Controller
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
        $pages=CustomePage::all();
        return view('admin.custome-page.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.custome-page.create');
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
            'page_name'=>'required',
            'description'=>'required',
        ]);

        $page=new CustomePage;
        $page->page_name=$request->page_name;
        $page->slug=Str::slug($request->page_name);
        $page->seo_title=$request->seo_title ? $request->seo_title : 'custom page seo title';
        $page->seo_description=$request->seo_description ? $request->seo_description : 'custom page seo description';
        $page->description=$request->description;
        $page->status=$request->status;
        $page->save();

        $notification=array(
            'messege'=>'Created Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.custom-page.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CustomePage  $customePage
     * @return \Illuminate\Http\Response
     */
    public function show(CustomePage $customePage)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CustomePage  $customePage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page=CustomePage::find($id);
        return view('admin.custome-page.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CustomePage  $customePage
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
            'page_name'=>'required',
            'description'=>'required',
        ]);

        $page=CustomePage::find($id);
        $page->page_name=$request->page_name;
        $page->slug=Str::slug($request->page_name);
        $page->seo_title=$request->seo_title ? $request->seo_title : 'custom page seo title';
        $page->seo_description=$request->seo_description ? $request->seo_description : 'custom page seo description';
        $page->description=$request->description;
        $page->status=$request->status;
        $page->save();

        $notification=array(
            'messege'=>'Update Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.custom-page.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CustomePage  $customePage
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CustomePage  $customePage
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


        CustomePage::destroy($id);
        $notification=array(
            'messege'=>'Deleted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.custom-page.index')->with($notification);
    }

    public function changeStatus($id){
        $page=CustomePage::find($id);
        if($page->status==1){
            $page->status=0;
            $message="In-active Successfully";
        }else{
            $page->status=1;
            $message="Active Successfully";
        }
        $page->save();
        return response()->json($message);

    }
}
