@extends('layouts.patient.layout')
@section('title')
<title>{{ $text->order_list }}</title>
@endsection
@section('patient-content')


<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->profile ? url($banner->profile) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $text->order_list }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $text->order_list }}</span></li>
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
                <h2 class="d-headline">{{ $text->order_list }}</h2>
                <div class="table-responsive">
                <table class="coustom-dashboard dashboard-table display" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $text->Serial_number }}</th>
                            <th width="5%">{{ $text->order_id }}</th>
                            <th width="5%">{{ $text->appointment_fee }}</th>
                            <th width="5%">{{ $text->total_appointment }}</th>
                            <th width="15%">{{ $text->date }}</th>
                            <th width="15%">{{ $text->payment }}</th>
                            <th width="15%">{{ $text->action }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->order_id }}</td>
                            <td>{{ $currency->currency_icon }}{{ $item->total_payment }}</td>
                            <td>{{ $item->appointment_qty }}</td>
                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                            <td>
                                @if ($item->payment_status==0)
                                        <span class="badge badge-danger">Pending</span>
                                    @else
                                    <span class="badge badge-success">Success</span>
                                    @endif
                            </td>
                            <td>
                                <a  data-toggle="modal" data-target="#orderDetails-{{ $item->id }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Dashboard End-->

@foreach ($orders as $item)
<!-- Modal -->
<div class="modal fade" id="orderDetails-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <h4>{{ $text->order_info }}:</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ $text->Serial_number }}</th>
                                <th>{{ $text->appointment_fee }}</th>
                                <th>{{ $text->payment_method }}</th>
                                <th>{{ $text->transaction_id }}</th>
                                <th>{{ $text->payment }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $item->order_id }}</td>
                                <td>{{ $currency->currency_icon }}{{ $item->total_payment }}</td>
                                <td>{{ $item->payment_method }}</td>
                                <td>{{ $item->payment_transaction_id }}</td>
                                <td>
                                    @if ($item->payment_status==0)
                                            <span class="badge badge-danger">Pending</span>
                                        @else
                                        <span class="badge badge-success">Success</span>
                                        @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h4 class="mt-4">{{ $text->appointment_history }}:</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ $text->Serial_number }}</th>
                                <th>{{ $text->doctor }}</th>
                                <th>{{ $text->phone }}</th>
                                <th>{{ $text->schedule }}</th>
                                <th>{{ $text->date }}</th>
                                <th>{{ $text->appointment_fee }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->appointments as $index => $item)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ ucfirst($item->doctor->name) }}</td>
                                <td>{{ $item->doctor->phone }}</td>
                                <td>{{ strtoupper($item->schedule->start_time).'-'.strtoupper($item->schedule->end_time) }}</td>
                                <td>{{ $item->date }}</td>
                                <td>
                                    ${{ $item->appointment_fee }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-danger btn-sm mt-3" data-dismiss="modal">{{ $text->appointment_close_btn }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach


@endsection
