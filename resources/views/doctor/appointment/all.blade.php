@extends('layouts.doctor.layout')
@section('title','All Appointment')
@section('doctor-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Appointment History</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">SN</th>
                            <th width="15%">Name</th>
                            <th width="15%">Email</th>
                            <th width="15%">Phone</th>
                            <th width="15%">Date</th>
                            <th width="25%">Time</th>
                            <th width="5%">Treated</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ ucfirst($item->user->name) }}</td>
                            <td>{{ $item->user->email }}</td>
                            <td>{{ $item->user->phone }}</td>
                            <td>{{ date('m-d-Y',strtotime($item->date)) }}</td>
                            <td>{{ strtoupper($item->schedule->start_time).'-'.strtoupper($item->schedule->end_time) }}</td>
                            <td>
                                @if ($item->already_treated==0)
                                <span class="badge badge-danger">No</span>
                                @else
                                <span class="badge badge-success">Yes</span>
                                @endif

                            </td>
                            <td>
                                @if ($item->already_treated==0)
                                <a  href="{{ route('doctor.treatment',$item->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                @else
                                <a  href="{{ route('doctor.already.treatment',$item->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                @endif

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>




@endsection
