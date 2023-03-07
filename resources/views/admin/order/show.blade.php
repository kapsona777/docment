@extends('layouts.admin.layout')
@section('title','Order')
@section('admin-content')
 <!-- Appointment Details -->
 <h2>Order Id: <b>{{ $order->order_id }}</b> </h2>
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
                        <td>{{ ucwords($order->user->name) }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $order->user->email }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{ $order->user->phone }}</td>
                    </tr>

                    <tr>
                        <td>Age</td>
                        <td>{{ $order->user->age }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Billing Info</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Appointment Fee</td>
                            <td>{{ $currency->currency_icon }}{{ $order->total_payment }}</td>
                        </tr>
                        <tr>
                            <td>Payment Method</td>
                            <td>{{ $order->payment_method }}</td>
                        </tr>
                        @if ($order->payment_transaction_id)
                        <tr>
                            <td>Transaction_id</td>
                            <td>{{ $order->payment_transaction_id }}</td>
                        </tr>
                        @endif
                        @if ($order->last4)
                            <tr>
                                <td>Last 4 digit of Stripe Card</td>
                                <td>{{ $order->last4 }}</td>
                            </tr>
                        @endif

                        @if ($order->payment_description)
                        <tr>
                            <td>Description</td>
                            <td>{!! clean(nl2br(e($order->payment_description))) !!}</td>
                        </tr>
                        @endif

                        <tr>
                            <td>Payment Status</td>
                            <td>
                                @if ($order->payment_status==1)
                                    <span class="badge badge-success">Success</span>
                                @else
                                <span class="badge badge-danger">Pending</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Appointment Info</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Doctor Name</th>
                            <th>Phone</th>
                            <th>Schedule</th>
                            <th>Date</th>
                            <th>Fee</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->appointments as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ ucfirst($item->doctor->name) }}</td>
                            <td>{{ $item->doctor->phone }}</td>
                            <td>{{ strtoupper($item->schedule->start_time).'-'.strtoupper($item->schedule->end_time) }}</td>
                            <td>{{ date('m-d-Y',strtotime($item->date)) }}</td>
                            <td>
                                {{ $currency->currency_icon }}{{ $item->appointment_fee }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @if ($order->payment_status==0)
        <a href="{{ route('admin.payment.accept',$order->id) }}" class="btn btn-success ml-3">Payment Accept</a>
    @endif
    <a href="{{ route('admin.cancle.order',$order->id) }}" class="btn btn-danger ml-3">Delete Order</a>

</div>

@endsection

