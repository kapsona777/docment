<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:doctor');
    }
    public function index(){
        $doctor=Auth::guard('doctor')->user();
        return view('doctor.schedule.index',compact('doctor'));
    }
}
