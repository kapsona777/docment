@extends('layouts.admin.layout')
@section('title','Email Template')
@section('admin-content')
<a href="{{ route('admin.email.template') }}" class="btn btn-success mb-2"><i class="fas fa-backward" aria-hidden="true"></i> Go Back</a>
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pre Notification Email</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <th>Variable</th>
                            <th>Meaning</th>
                        </thead>
                        <tbody>
                            <tr>
                                @php
                                    $patient_name="{{patient_name}}";
                                @endphp
                                <td>{{ $patient_name }}</td>
                                <td>Patient Name</td>
                            </tr>

                            <tr>
                                @php
                                    $schedule_start_time="{{schedule}}";
                                @endphp
                                <td>{{ $schedule_start_time }}</td>
                                <td>Schedule Time</td>
                            </tr>

                            <tr>
                                @php
                                    $schedule_date="{{date}}";
                                @endphp
                                <td>{{ $schedule_date }}</td>
                                <td>Schedule Date</td>
                            </tr>

                            <tr>
                                @php
                                    $doctor="{{doctor}}";
                                @endphp
                                <td>{{ $doctor }}</td>
                                <td>Doctor Name</td>
                            </tr>






                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">
                    
                    <form action="{{ route('admin.email.update',$email->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Subject <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ $email->subject }}" name="subject">
                        </div>
                        <div class="form-group">
                            <label for="">Description <span class="text-danger">*</span></label>
                            <textarea name="description" cols="30" rows="10" class="form-control summernote">{{ $email->description }}</textarea>

                        </div>

                        <button class="btn btn-success" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

