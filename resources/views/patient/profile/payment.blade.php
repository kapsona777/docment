@extends('layouts.patient.layout')
@section('title')
<title>Payment</title>
@endsection
@section('patient-content')


<!--Banner Start-->
<div class="banner-area flex" style="background-image:url({{ $banner->payment ?  url($banner->payment) : '' }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-text">
                    <h1>{{ $navigation->payment }}</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">{{ $navigation->home }}</a></li>
                        <li><span>{{ $navigation->payment }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->

<!--Check Out Start-->
<div class="check-out pt_40 pb_70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="checkout-table table-responsive">

                    <h4>{{ $text->appointment_list }}</h4>

                    <table class="table">
                        <thead>
                            <tr>
                                <th><b>Doctor Name</b></th>
                                <th><b>Department</b></th>
                                <th><b>Location</b></th>
                                <th><b>Date</b></th>
                                <th><b>Time</b></th>
                                <th><b>Fee ({{ $currency->currency_name }})</b></th>
                                <th><b>Action</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $i => $item)
                            <tr>
                                <td>{{ ucfirst($item->name) }}</td>
                                <td>{{ $item->options->department }}</td>
                                <td>{{ $item->options->location }}</td>
                                <td>{{ $item->options->date }}</td>
                                <td>{{ strtoupper($item->options->time) }}</td>
                                <td>{{ $currency->currency_icon }}{{ $item->price }}</td>
                                <td><a href="{{ url('remove-appointment/'.$item->rowId) }}" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a></td>
                            </tr>
                            @endforeach


                            <tr>
                                <td class="text-right" colspan="5"><b>Total</b></td>
                                <td class="" colspan="2"><b>{{ $currency->currency_icon }}{{ Cart::pricetotal() }}</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if ($appointments->count() !=0)
        <div class="row">
            <div class="col-12">
                <div class="payment-select">
                    <h4>{{ $text->pay_now }}</h4>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="stripe-tab" data-toggle="tab" href="#stripe" role="tab" aria-controls="stripe" aria-selected="true">{{ $text->stripe }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="paypal-tab" data-toggle="tab" href="#paypal" role="tab" aria-controls="paypal" aria-selected="false">{{ $text->paypal }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="bank-tab" data-toggle="tab" href="#bank" role="tab" aria-controls="bank" aria-selected="false">{{ $text->bank_transfer }}</a>
                        </li>

                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active mt-5" id="stripe" role="tabpanel" aria-labelledby="stripe-tab">
                            <div class="payment-select-group">
                                @if (Session::has('success'))
                                    <div class="alert alert-success text-center">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        <p>{{ Session::get('success') }}</p>
                                    </div>
                                @endif
                                <form role="form" action="{{ route('patient.stripe.payment') }}" method="post" class="require-validation"
                                data-cc-on-file="false"
                                data-stripe-publishable-key="{{ $stripe->stripe_key }}"
                                id="payment-form">
                                @csrf

                                <div class='form-row row mt_30'>
                                    <div class='col-sm-6 col-12 form-group required'>
                                        <label class='control-label'>{{ $text->card_number }}</label> <input
                                            autocomplete='off' class='form-control card-number' size='20'
                                            type='text' name="card_digit">
                                    </div>


                                    <div class='col-sm-6 col-12 form-group cvc required'>
                                        <label class='control-label'>{{ $text->cvc }}</label> <input autocomplete='off'
                                            class='form-control card-cvc' size='4'
                                            type='text'>
                                    </div>

                                    <div class='col-sm-6 col-12 form-group expiration required'>
                                        <label class='control-label'>{{ $text->expiration_month }}</label> <input
                                            class='form-control card-expiry-month' size='2'
                                            type='text'>
                                    </div>

                                    <div class='col-sm-6 col-12 form-group expiration required'>
                                        <label class='control-label'>{{ $text->expiration_year }}</label> <input
                                            class='form-control card-expiry-year'  size='4'
                                            type='text'>
                                    </div>
                                </div>
                                <div class='form-row row'>
                                    <div class='col-md-12 error form-group hide d-none'>
                                        <div class='alert-danger alert'>{{ $text->stripe_card_error }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="payment-order-button col-3">
                                    <button type="submit">{{ $text->stripe_btn }}</button>
                                </div>
                            </div>
                        </form>
                        </div>
                        <div class="tab-pane fade mt-5" id="paypal" role="tabpanel" aria-labelledby="paypal-tab">
                            <form action="{{ url('patient/store-paypal') }}" method="POST">
                                @csrf
                            <div class="row">

                                <div class="payment-order-button col-3">
                                    <button type="submit">{{ $text->paypal_btn }}</button>
                                </div>

                            </div>
                        </form>
                        </div>

                        <div class="tab-pane fade mt-5" id="bank" role="tabpanel" aria-labelledby="bank-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="{{ route('patient.bank.payment') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="description">{{ $text->transaction_info }}</label>
                                            <textarea name="description" id="description" cols="30" rows="10" class="form-control" required></textarea>
                                        </div>

                                        <div class="payment-order-button">
                                            <button type="submit">{{ $text->bank_transfer_btn }}</button>
                                        </div>

                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <div class="bank contact-info-item bg2 mb_30 mt_30">
                                        <div class="contact-info">
                                            <span>
                                                {{ $text->bank_account_info }}:
                                            </span>
                                            <div class="contact-text">
                                                <p class="card-text">
                                                    {!! clean(nl2br(e($stripe->bank_account))) !!}</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>


                      </div>

                </div>

            </div>
        </div>
        @endif
    </div>
</div>
<!--Check Out End-->




@endsection
