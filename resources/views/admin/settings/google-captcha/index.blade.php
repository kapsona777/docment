@extends('layouts.admin.layout')
@section('title','Settings')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Google Captcha Settings</h6>
                </div>
                <div class="card-body">
                   
                    <form action="{{ route('admin.update.captcha.setting') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="">Allow Google Recaptcha</label>
                            <select name="allow_captcha" id="" class="form-control">
                                <option {{ $setting->allow_captcha==1 ? 'selected':'' }} value="1">Yes</option>
                                <option {{ $setting->allow_captcha==0 ? 'selected':'' }} value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="captcha_key">Recaptcha Site Key</label>
                            <input type="text" class="form-control" name="captcha_key" id="captcha_key" value="{{ $setting->captcha_key }}">
                        </div>



                        <div class="form-group">
                            <label for="captcha_secret">Recaptcha Secret Key</label>
                            <input type="text" class="form-control" name="captcha_secret" id="captcha_secret" value="{{ $setting->captcha_secret }}">
                        </div>


                        <button type="submit" class="btn btn-success">Save Info</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
