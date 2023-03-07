@extends('layouts.patient.layout')
@section('title')
<title>{{ $text->appointment_list }}</title>
@endsection
@section('patient-content')


<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->profile ? url($banner->profile) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $text->appointment_list }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $text->appointment_list }}</span></li>
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
                <h2 class="d-headline">{{ $text->appointment_list }}</h2>
                <div class="table-responsive">
                <table class="coustom-dashboard dashboard-table display" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th  width="3%">{{ $text->Serial_number }}</th>
                                <th  width="15%">{{ $text->doctor }}</th>
                                <th  width="20%">{{ $text->date }}</th>
                                <th  width="10%">{{ $text->appointment_fee }}</th>
                                <th  width="30%">{{ $text->schedule }}</th>
                                <th  width="10%">{{ $text->payment }}</th>
                                <th  width="7%">{{ $text->treated }}</th>
                                <th  width="5%">{{ $text->action }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $index => $appointment)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ ucfirst($appointment->doctor->name) }}</td>
                                <td>{{ date('m-d-Y',strtotime($appointment->date)) }}</td>
                                <td>{{ $currency->currency_icon }}{{ $appointment->appointment_fee }}</td>
                                <td>{{ strtoupper($appointment->schedule->start_time).'-'.strtoupper($appointment->schedule->end_time) }}</td>
                                <td>
                                    @if ($appointment->payment_status==0)
                                        <span class="badge badge-danger">Pending</span>
                                    @else
                                    <span class="badge badge-success">Success</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($appointment->already_treated==0)
                                        <span class="badge badge-danger">No</span>
                                    @else
                                    <span class="badge badge-success">Yes</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($appointment->already_treated==1)
                                    <a class="db-bt-ed" href="{{ route('patient.shwo.appointment',$appointment->id) }}" ><i class="fas fa-eye    "></i></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                    {{ $appointments->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Dashboard End-->
@endsection
