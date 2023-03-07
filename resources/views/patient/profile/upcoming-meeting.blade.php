@extends('layouts.patient.layout')
@section('title')
<title>{{ $text->upcoming_meeting }}</title>
@endsection
@section('patient-content')


<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->profile ? url($banner->profile) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $text->upcoming_meeting }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $text->upcoming_meeting }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->

<!--Dashboard Start-->
<div class="dashboard-area pt_70 pb_70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @include('patient.profile.sidebar')
            </div>
            <div class="col-lg-9">
                <div class="detail-dashboard">
                    <h2 class="d-headline">{{ $text->upcoming_meeting }}</h2>
                    <div class="table-responsive">
                        <table class="coustom-dashboard dashboard-table display" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th >{{ $text->Serial_number }}</th>
                                    <th >{{ $text->doctor }}</th>
                                    <th >{{ $text->time }}</th>
                                    <th >{{ $text->duration }}</th>
                                    <th >{{ $text->meeting_id }}</th>
                                    <th >{{ $text->join_link }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($histories as $index => $meeting)
                                    @php
                                        $now=date('Y-m-d h:i:A');
                                    @endphp

                                    @if ($now < date('Y-m-d h:i:A',strtotime($meeting->meeting_time)))
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $meeting->user->name }}</td>
                                            <td>
                                                {{ date('Y-m-d h:i:A',strtotime($meeting->meeting_time)) }}
                                            </td>
                                            <td>{{ $meeting->duration }} {{ $text->minute }}</td>
                                            <td>{{ $meeting->meeting->meeting_id }}</td>
                                            <td>

                                                @if (env('PROJECT_MODE')==0)
                                                    <a id="zoom_demo_mode" href="javascript:;"  class="btn btn-success btn-sm"><i class="fas fa-video"></i></a>
                                                @else
                                                    <a target="_blank" href="{{ $meeting->meeting->join_url }}" class="btn btn-success btn-sm"><i class="fas fa-video"></i></a>
                                                @endif
                                                </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Dashboard End-->


@endsection
