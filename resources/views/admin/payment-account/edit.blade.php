@extends('layouts.admin.layout')
@section('title','Payment Account')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Payment Account Information</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.payment-account.update',$paymentAccount->id) }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="">Paypal Account Mode</label>
                            <select name="account_mode" id="" class="form-control">
                                <option {{ $paymentAccount->account_mode=='live' ? 'selected':'' }} value="live">Live</option>
                                <option {{ $paymentAccount->account_mode=='sandbox' ? 'selected':'' }} value="sandbox">Sandbox</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="paypal_client_id">Paypal Client Id</label>
                            <textarea name="paypal_client_id" id="paypal_client_id" cols="30" rows="2" class="form-control">{{ $paymentAccount->paypal_client_id }}</textarea>
                            
                        </div>
                        <div class="form-group">
                            <label for="paypal_secret">Paypal Secret Key</label>
                            <textarea name="paypal_secret" id="paypal_secret" cols="30" rows="2" class="form-control" >{{ $paymentAccount->paypal_secret }}</textarea>
                            
                        </div>
                        <div class="form-group">
                            <label for="stripe_key">Stripe Key</label>
                            <textarea name="stripe_key" id="stripe_key" cols="30" rows="2" class="form-control">{{ $paymentAccount->stripe_key }}</textarea>
                            
                        </div>
                        <div class="form-group">
                            <label for="stripe_secret">Stripe Secret</label>
                            <textarea name="stripe_secret" id="stripe_secret" cols="30" rows="2" class="form-control">{{ $paymentAccount->stripe_secret }}</textarea>
                            
                        </div>
                        <div class="form-group">
                            <label for="bank_account">Bank Account Detail</label>
                            <textarea name="bank_account" id="bank_account" cols="30" rows="5" class="form-control" >{{ $paymentAccount->bank_account }}</textarea>
                            
                        </div>



                        <button type="submit" class="btn btn-success">Save Informtion</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
