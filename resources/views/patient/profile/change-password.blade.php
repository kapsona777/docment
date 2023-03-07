@extends('layouts.patient.layout')
@section('title')
<title>{{ $text->change_password }}</title>
@endsection
@section('patient-content')


<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ url($banner->profile) }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $text->change_password }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $text->change_password }}</span></li>
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
                <div class="detail-dashboard add-form">
                    <h2 class="d-headline">{{ $text->change_password }}</h2>
                    <form action="{{ route('patient.update.password') }}" method="post">
                        @csrf
                        <div class="form-row row">
                            <div class="form-group col-md-6">
                                <label for="">{{ $text->password }} <span>*</span></label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{ $text->confirm_password }} <span>*</span></label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary">{{ $text->change_password_btn }}</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!--Dashboard End-->

@endsection
