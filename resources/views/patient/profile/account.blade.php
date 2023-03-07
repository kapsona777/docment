@extends('layouts.patient.layout')
@section('title')
<title>{{ $text->account_info }}</title>
@endsection
@section('patient-content')


<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->profile ? url($banner->profile) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $text->account_info }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $text->account_info }}</span></li>
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
                    <h2 class="d-headline">{{ $text->account_info }}</h2>
                    <form action="{{ route('patient.update.profile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row row">
                            <div class="form-group col-md-6">
                                <label for="name">{{ $text->name }} <span>*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">{{ $text->email_address }} <span>*</span></label>
                                <input type="text" class="form-control" id="email" name="email"  value="{{ $user->email }}" readonly>
                                
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{ $text->phone }} <span>*</span></label>
                                <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                                
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{ $text->guardian_name }}</label>
                                <input type="text" class="form-control" name="guardian_name"  value="{{ $user->guardian_name }}">
                                
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{ $text->guardian_phone }}</label>
                                <input type="text" class="form-control" name="guardian_phone"  value="{{ $user->guardian_phone }}">
                                
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{ $text->patient_age }}<span>*</span></label>
                                <input type="number" class="form-control" name="age" value="{{ $user->age }}">
                                
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{ $text->occupation }}<span>*</span></label>
                                <input type="text" class="form-control" name="occupation"  value="{{ $user->occupation }}">
                                
                            </div>

                            <div class="form-group col-md-6 option-item">
                                <label for="">{{ $text->gender }} <span>*</span></label>
                                <select class="form-control" name="gender">
                                    <option value="">{{ $text->select_gender }}</option>
                                    <option {{ $user->gender==$text->male ? 'selected':'' }} value="{{ $text->male }}">{{ $text->male }}</option>
                                    <option {{ $user->gender==$text->female ? 'selected':'' }} value="{{ $text->female }}">{{ $text->female }}</option>
                                    <option {{ $user->gender==$text->others ? 'selected':'' }} value="{{ $text->others }}">{{ $text->others }}</option>
                                </select>
                                
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">{{ $text->address }} <span>*</span></label>
                                <input type="text" class="form-control" name="address" value="{{ $user->address }}">
                                
                            </div>

                            <div class="form-group col-md-6 option-item">
                                <label for="">{{ $text->country }} <span>*</span></label>
                                <input type="text" name="country" class="form-control" value="{{ $user->country }}">
                                
                            </div>
                            <div class="form-group col-md-6 option-item">
                                <label for="">{{ $text->city }} <span>*</span></label>
                                <input type="text" name="city" placeholder="City" class="form-control" value="{{ $user->city }}">
                                
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">{{ $text->photo }}</label>
                                <input type="file" class="form-control-file" name="image">
                                <input type="hidden" name="old_image" value="{{ $user->image }}">
                                
                            </div>

                            <div class="form-group col-md-6 option-item">
                                <label for="">{{ $text->date_of_birth }} </label>
                                <input type="text" class="form-control datepicker2" name="date_of_birth" value="{{ $user->date_of_birth }}">
                            </div>
                            <div class="form-group col-md-6 option-item">
                                <label for="">{{ $text->weight }}</label>
                                <input type="text" class="form-control" name="weight" value="{{ $user->weight }}">
                            </div>
                            <div class="form-group col-md-6 option-item">
                                <label for="">{{ $text->height }}</label>
                                <input type="text" class="form-control" name="height" value="{{ $user->height }}">
                            </div>
                            <div class="form-group col-md-6 option-item">
                                <label for="">{{ $text->helth_insurance_number }}</label>
                                <input type="text" class="form-control" name="health_insurance_number" value="{{ $user->health_insurance_number }}">
                            </div>
                            <div class="form-group col-md-6 option-item">
                                <label for="">{{ $text->helth_card_number }}</label>
                                <input type="text" class="form-control" name="health_card_number" value="{{ $user->health_card_number }}">
                            </div>
                            <div class="form-group col-md-6 option-item">
                                <label for="">{{ $text->helth_card_provider }}</label>
                                <input type="text" class="form-control" name="health_card_provider" value="{{ $user->health_card_provider }}">
                            </div>
                            <div class="form-group col-md-6 option-item">
                                <label for="">{{ $text->blood_group }}</label>
                                <input type="text" class="form-control" name="blood_group" value="{{ $user->blood_group }}">
                            </div>
                            <div class="form-group col-md-6 option-item">
                                <label for="">{{ $text->disablities }}</label>
                                <input type="text" class="form-control" name="disabilities" value="{{ $user->disabilities }}">
                            </div>
                             <!-- HTML -->


                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary">{{ $text->update_profile_btn }}</button>
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
