@extends('layouts.doctor.layout')
@section('title','Appointment History')
@section('doctor-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ ucwords($appointments[0]->user->name) }}'s Appointment History</h6>
        </div>
        <div class="card-body" id="search-appointment">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">SN</th>
                            <th width="15%">Name</th>
                            <th width="15%">Email</th>
                            <th width="15%">Doctor</th>
                            <th width="15%">Department</th>
                            <th width="15%">Date</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ ucfirst($item->user->name) }}</td>
                            <td>{{ $item->user->email }}</td>
                            <td>{{ ucwords($item->doctor->name) }}</td>
                            <td>{{ ucwords($item->doctor->department->name) }}</td>
                            <td>{{ date('m-d-Y',strtotime($item->date)) }}</td>

                            <td>
                                <a target="_blank" href="{{ route('doctor.treatment',$item->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
