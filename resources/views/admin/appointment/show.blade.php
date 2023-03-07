@extends('layouts.admin.layout')
@section('title','Appointment')
@section('admin-content')
 <!-- Appointment Details -->
 <div class="row">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Patient Info</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <td>Name</td>
                        <td>{{ ucwords($appointment->user->name) }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $appointment->user->email }}</td>
                    </tr>
                    <tr>
                        <td>Age</td>
                        <td>{{ $appointment->user->age }}</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>{{ $appointment->user->gender }}</td>
                    </tr>
                    @if ($appointment->user->disabilities)
                    <tr>
                        <td>Disablities</td>
                        <td>{{ $appointment->user->disabilities }}</td>
                    </tr>
                    @endif


                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Appointment Info</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <td>Doctor</td>
                        <td>{{ ucwords($appointment->doctor->name) }}({{ $appointment->doctor->designations }})</td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td>{{ date('m-d-Y',strtotime($appointment->date)) }}</td>
                    </tr>

                    <tr>
                        <td>Time</td>
                        <td>{{ $appointment->schedule->start_time.'-'.$appointment->schedule->end_time }}</td>
                    </tr>

                    <tr>
                        <td>Already Treated</td>
                        <td>
                            @if ($appointment->already_treated==1)
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-danger">No</span>
                            @endif
                        </td>
                    </tr>


                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Billing Info</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <th>Order Id</th>
                        <th>Appointment Fee</th>
                        <th>Payment Status</th>
                        <th>Payment Method</th>
                        <th>Transaction Id</th>
                        <th>Description</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $appointment->order->order_id }}</td>
                            <td>{{ $currency->currency_icon }}{{ $appointment->appointment_fee }}</td>
                            <td>
                                @if ($appointment->payment_status==1)
                                    <span class="badge badge-success">Success</span>
                                @else
                                <span class="badge badge-danger">Pending</span>
                                @endif
                            </td>
                            <td>{{ $appointment->payment_method }}</td>
                            <td>{{ $appointment->payment_transaction_id }}</td>
                            <td>{!! clean(nl2br(e($appointment->payment_description))) !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection

