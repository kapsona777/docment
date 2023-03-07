@extends('layouts.admin.layout')
@section('title','Notification Text')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Notification Text</h6>
                </div>
                <div class="card-body">
                    
                    <form action="{{ route('admin.update.notification.text') }}" method="post">
                    @csrf
                    <table class="table table-bordered">

                        <tr>
                            <td>Login Successfull</td>
                            <td><input type="text" name="login_success" value="{{ $text->login_success }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Login Credential Invalid</td>
                            <td><input type="text" name="login_credential" value="{{ $text->login_credential }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Inactive User</td>
                            <td><input type="text" name="inactive_user" value="{{ $text->inactive_user }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Invalid Email</td>
                            <td><input type="text" name="invalid_email" value="{{ $text->invalid_email }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Logout Successfully</td>
                            <td><input type="text" name="logout_success" value="{{ $text->logout_success }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Registration Confirm</td>
                            <td><input type="text" name="register_confirm" value="{{ $text->register_confirm }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Successfully Email Verification</td>
                            <td><input type="text" name="successfull_verification" value="{{ $text->successfull_verification }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Invalid Verification Token</td>
                            <td><input type="text" name="invalid_token" value="{{ $text->invalid_token }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Forget Password Successfull</td>
                            <td><input type="text" name="forget_password" value="{{ $text->forget_password }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Contact Message Send Successfully</td>
                            <td><input type="text" name="contact_message" value="{{ $text->contact_message }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Appointment added Successfully</td>
                            <td><input type="text" name="appointment_added" value="{{ $text->appointment_added }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Appointment Removed Successfully</td>
                            <td><input type="text" name="appointment_removed" value="{{ $text->appointment_removed }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Please Fill Out your profile</td>
                            <td><input type="text" name="fill_up_profile" value="{{ $text->fill_up_profile }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Payment Successfull</td>
                            <td><input type="text" name="payment_successfull" value="{{ $text->payment_successfull }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Payment Faild</td>
                            <td><input type="text" name="payment_faild" value="{{ $text->payment_faild }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Account Updated</td>
                            <td><input type="text" name="account_update" value="{{ $text->account_update }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Password Changed Successfully</td>
                            <td><input type="text" name="password_change" value="{{ $text->password_change }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Comment Successfull</td>
                            <td><input type="text" name="comment_success" value="{{ $text->comment_success }}" class="form-control"></td>
                        </tr>


                        <tr>
                            <td>Verify Subscribe Email</td>
                            <td><input type="text" name="verify_subscribe" value="{{ $text->verify_subscribe }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Already Subscribed</td>
                            <td><input type="text" name="already_subscribe" value="{{ $text->already_subscribe }}" class="form-control"></td>
                        </tr>


                        <tr>

                            <td>Subscribed Successfully</td>
                            <td><input type="text" name="successfully_subscribe" value="{{ $text->successfully_subscribe }}" class="form-control"></td>
                        </tr>

                    </table>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
