<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MeetingHistory;
use App\BannerImage;
use App\Navigation;
use App\ManageText;
use Auth;
class MeetingController extends Controller
{
    protected $banner;
    public function __construct()
    {

        $this->middleware('auth:web');
        $this->banner=BannerImage::first();
    }
    public function meetingHistory(){
        $user=Auth::guard('web')->user();
        $histories=MeetingHistory::where('user_id',$user->id)->orderBy('meeting_time','desc')->paginate(10);
        $banner=$this->banner;
        $navigation=Navigation::first();
        $text=ManageText::first();
        return view('patient.profile.meeting-history',compact('histories','navigation','banner','user','text'));
    }

    public function upCommingMeeting(){
        $user=Auth::guard('web')->user();
        $histories=MeetingHistory::where('user_id',$user->id)->orderBy('meeting_time','desc')->get();
        $banner=$this->banner;
        $navigation=Navigation::first();
        $text=ManageText::first();
        return view('patient.profile.upcoming-meeting',compact('histories','navigation','banner','user','text'));
    }
}
