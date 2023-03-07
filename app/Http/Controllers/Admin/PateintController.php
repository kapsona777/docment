<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Appointment;
use App\Order;
use App\Message;
use App\BannerImage;
use App\MeetingHistory;
use DB;
class PateintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $patients=User::orderBy('id','desc')->get();
        return view('admin.patient.index',compact('patients'));
    }

    public function show($id){
        $patient=User::find($id);
        $user_image=BannerImage::first();
        return view('admin.patient.show',compact('patient','user_image'));
    }

    public function search(Request $request){


        $from_date=date('Y-m-d',strtotime($request->from_date));
        $to_date=date('Y-m-d',strtotime($request->to_date));

        $patients=User::whereDate('created_at','>=',$from_date);
        $patients=$patients->whereDate('created_at','<=',$to_date);
        $patients=$patients->get();
        return view('admin.patient.ajax-patient',compact('patients'));
    }


        // change user status
        public function changeStatus($id){
            $user=User::find($id);
            if($user->status==1){
                $user->status=0;
                $message="In-active Successfully";
            }else{
                $user->status=1;
                $message="Active Successfully";
            }
            $user->save();
            return response()->json($message);

        }

        public function delete($id){

            // project demo mode check
         if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

            Appointment::where('user_id',$id)->delete();
            Order::where('user_id',$id)->delete();
            Message::where('user_id',$id)->delete();
            MeetingHistory::where('user_id',$id)->delete();

            $user=User::where('id',$id)->first();
            $user->delete();
            $notification=array(
                'messege'=>'Deleted Successfully',
                'alert-type'=>'success'
            );

            return redirect()->back()->with($notification);
        }
}
