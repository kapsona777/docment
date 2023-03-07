<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BlogComment;
class BlogCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function allComments(){
        $comments=BlogComment::all();

        return view('admin.blog.comment.index',compact('comments'));
    }

    public function deleteComment($id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        // end

        BlogComment::destroy($id);
        $notification=array(
            'messege'=>'Deleted Successfully',
            'alert-type'=>'success'
        );

        return back()->with($notification);

    }

    // manage comment status
    public function changeStatus($id){
        $comment=BlogComment::find($id);
        if($comment->status==1){
            $comment->status=0;
            $message="In-active Successfully";
        }else{
            $comment->status=1;
            $message="Active Successfully";
        }
        $comment->save();
        return response()->json($message);

    }
}
