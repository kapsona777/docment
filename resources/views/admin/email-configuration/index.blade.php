@extends('layouts.admin.layout')
@section('title','Email Configuration')
@section('admin-content')
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Email Configuration</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.update-email-configuraion') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Mail Host</label>
                                <input type="text" name="mail_host" value="{{ $email->mail_host }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Send Email From</label>
                                    <input type="email" name="email" value="{{ $email->email }}" class="form-control">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">SMTP Username</label>
                                    <input type="text" name="smtp_username" value="{{ $email->smtp_username }}" class="form-control">
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">SMTP Password</label>
                                    <input type="text" name="smtp_password" value="{{ $email->smtp_password }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mail_port">Mail Port</label>
                                    <input type="text" name="mail_port" value="{{ $email->mail_port }}" class="form-control" id="mail_port">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mail_encryption">Mail Encryption </label>
                                    <select name="mail_encryption" id="mail_encryption" class="form-control">
                                        <option {{ $email->mail_encryption=='tls' ? 'selected' :'' }} value="tls">TLS</option>
                                        <option {{ $email->mail_encryption=='ssl' ? 'selected' :'' }} value="ssl">SSL</option>
                                    </select>
                                </div>
                            </div>
                        </div>



                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
