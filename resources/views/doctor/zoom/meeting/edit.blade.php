@extends('layouts.doctor.layout')
@section('title','Zoom Meeting')
@section('doctor-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('doctor.zoom-meetings') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> Meeting List </a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Meeting Form</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('doctor.update-zoom-meeting',$meeting->meeting_id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Topic</label>
                            <input type="text" class="form-control" name="topic" value="{{ $meeting->topic }}">
                        </div>
                        <div class="form-group">
                            <label for="">Start Time</label>
                            @php
                                $date=date('Y-m-d h:i:s',strtotime($meeting->start_time));
                            @endphp
                            <input id="dateandtimepicker" class="form-control" name="start_time" value="{{ $date }}">
                        </div>

                        <div class="form-group">
                            <label for="">Duration</label>

                            <input type="number" class="form-control" name="duration" value="{{ $meeting->duration }}">
                        </div>

                        <div class="form-group">
                            <label for="">Select Patient</label>
                            <select name="patient" class="form-control select2" id="patient">
                                <option value="">Select Patient</option>
                                <option value="-1">All Patient</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <button class="btn btn-primary" type="submit"> Update</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        $("#dateandtimepicker").datetimepicker({
            format: 'Y-m-d H:i:s',
            formatTime: 'H:i:s',
            formatDate: 'Y-m-d',
            step: 5,
            minDate:0,
            minTime:0
        })
    </script>

@endsection
