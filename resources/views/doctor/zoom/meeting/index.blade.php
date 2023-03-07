@extends('layouts.doctor.layout')
@section('title','Zoom Meeting')
@section('doctor-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('doctor.create-zoom-meeting') }}" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> New Meeting </a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Meeting Table</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th >SN</th>
                            <th >Start Time</th>
                            <th >Duration</th>
                            <th >Meeting Id</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($meetings as $index => $meeting)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ date('Y-m-d h:i:A',strtotime($meeting->start_time)) }}</td>
                            <td>{{ $meeting->duration }} Minute</td>
                            <td>{{ $meeting->meeting_id }}</td>
                            <td>{{ $meeting->password }}</td>

                            <td>

                                @if (env('PROJECT_MODE')==0)
                                    <a id="zoom_demo_mode" href="javascript:;"  class="btn btn-success btn-sm"><i class="fas fa-video"></i></a>
                                @else

                                <a target="_blank" href="{{ $meeting->join_url }}" class="btn btn-success btn-sm"><i class="fas fa-video"></i></a>
                                @endif

                                <a href="{{ route('doctor.edit-zoom-meeting',$meeting->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <a onclick="return confirm('Are You Sure? ')" href="{{ route('doctor.delete-zoom-meeting',$meeting->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>




                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        (function($) {
        "use strict";
        $(document).ready(function () {
            $(document).on('click', '#zoom_demo_mode', function () {
                var demoNotify="{{ env('NOTIFY_TEXT') }}"
                toastr.error(demoNotify);
            });
        });
        })(jQuery);

        </script>

@endsection
