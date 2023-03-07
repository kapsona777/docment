<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MeetingHistory;
class MeetingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function meetingHistory(){
        $histories=MeetingHistory::OrderBy('id','desc')->get();
        return view('admin.zoom.meeting-history',compact('histories'));
    }
}
