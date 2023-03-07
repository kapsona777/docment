<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\BlogCategory;
use App\BlogComment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use Str;
use Storage;
use File;
class BlogController extends Controller
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
        $blogs=Blog::with('category')->get();
        return view('admin.blog.blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=BlogCategory::all();
        return view('admin.blog.blog.create',compact('categories'));
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
            'title'=>'required|unique:blogs',
            'category'=>'required',
            'image'=>'required',
            'sort_description'=>'required',
            'description'=>'required',
            'status'=>'required',
            'show_feature_blog'=>'required',
        ]);

        $image=$request->image;
        $extention=$image->getClientOriginalExtension();

         // for small image
        $name= 'blog-thumbnail-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $thumbnail_path='uploads/custom-images/'.$name;
        Image::make($image)
                ->resize(348,220)
                ->save('public/'.$thumbnail_path);

        // large image
        $name= 'blog-feature-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $feature_path='uploads/custom-images/'.$name;
        Image::make($image)
                ->resize(728,410)
                        ->save('public/'.$feature_path);

        Blog::create([
            'title'=>$request->title,
            'seo_title'=>$request->seo_title ? $request->seo_title : 'blog seo title',
            'slug'=>Str::slug($request->title),
            'blog_category_id'=>$request->category,
            'sort_description'=>$request->sort_description,
            'seo_description'=>$request->seo_description ? $request->seo_description : 'blog seo description',
            'description'=>$request->description,
            'thumbnail_image'=>$thumbnail_path,
            'feature_image'=>$feature_path,
            'status'=>$request->status,
            'show_feature_blog'=>$request->show_feature_blog,
        ]);


        $notification=array(
            'messege'=>'Created Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.blog.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $categories=BlogCategory::all();
        return view('admin.blog.blog.edit',compact('categories','blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
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
            'title'=>'required|unique:blogs,title,'.$blog->id,
            'category'=>'required',
            'sort_description'=>'required',
            'description'=>'required',
            'status'=>'required',
            'show_feature_blog'=>'required',
        ]);

        // for thumbnail image
        if($request->file('image')){
            $old_thumbnail=$blog->thumbnail_image;
            $old_feature=$blog->feature_image;

            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            // small image
            $name= 'blog-thumbnail-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $thumbnail_path='uploads/custom-images/'.$name;
            Image::make($image)
                    ->resize(348,220)
                    ->save('public/'.$thumbnail_path);

            // large image
            $name= 'blog-feature-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $feature_path='uploads/custom-images/'.$name;
            Image::make($image)
                    ->resize(728,410)
                    ->save('public/'.$feature_path);

            $blog->title=$request->title;
            $blog->slug=Str::slug($request->title);
            $blog->sort_description=$request->sort_description;
            $blog->description=$request->description;
            $blog->blog_category_id=$request->category;
            $blog->status=$request->status;
            $blog->seo_title=$request->seo_title ? $request->seo_title : 'blog seo title';
            $blog->seo_description=$request->seo_description ? $request->seo_description: 'blog seo description';
            $blog->show_feature_blog=$request->show_feature_blog;
            $blog->feature_image=$feature_path;
            $blog->thumbnail_image=$thumbnail_path;
            $blog->save();

            // delete Old Image
            if(File::exists('public/'.$old_thumbnail))unlink('public/'.$old_thumbnail);
            if(File::exists('public/'.$old_feature))unlink('public/'.$old_feature);
        }else{
            $blog->title=$request->title;
            $blog->slug=Str::slug($request->title);
            $blog->sort_description=$request->sort_description;
            $blog->description=$request->description;
            $blog->blog_category_id=$request->category;
            $blog->status=$request->status;
            $blog->seo_title=$request->seo_title ? $request->seo_title : 'blog seo title';
            $blog->seo_description=$request->seo_description ? $request->seo_description: 'blog seo description';
            $blog->show_feature_blog=$request->show_feature_blog;
            $blog->save();
        }

        $notification=array(
            'messege'=>'Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.blog.index')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
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

        $old_thumbnail=$blog->thumbnail_image;
        $old_feature=$blog->feature_image;
        $blog->delete();
        // delete Old Image
        if(File::exists('public/'.$old_thumbnail))unlink('public/'.$old_thumbnail);
        if(File::exists('public/'.$old_feature))unlink('public/'.$old_feature);
        $notification=array(
            'messege'=>'Deleted Successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.blog.index')->with($notification);
    }

    // manage blog status
    public function changeStatus($id){
        $blog=Blog::find($id);
        if($blog->status==1){
            $blog->status=0;
            $message="In-active Successfully";
        }else{
            $blog->status=1;
            $message="Active Successfully";
        }
        $blog->save();
        return response()->json($message);

    }


}
