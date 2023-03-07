@extends('layouts.admin.layout')
@section('title','Navigation')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Navigation Text</h6>
                </div>
                <div class="card-body">
                    
                    <form action="{{ route('admin.update.navigation') }}" method="POST">
                        @csrf
                    <table class="table table-bordered">
                        <tr>
                            <td>Home Page</td>
                            <td><input type="text" class="form-control" name="home" value="{{ $navigation->home }}"></td>
                        </tr>
                        <tr>
                            <td>About Page</td>
                            <td><input type="text" class="form-control" name="about_us" value="{{ $navigation->about_us }}"></td>
                        </tr>
                        <tr>
                            <td>Pages</td>
                            <td><input type="text" class="form-control" name="pages" value="{{ $navigation->pages }}"></td>
                        </tr>
                        <tr>
                            <td>Doctor Page</td>
                            <td><input type="text" class="form-control" name="doctor" value="{{ $navigation->doctor }}"></td>
                        </tr>
                        <tr>
                            <td>Service Page</td>
                            <td><input type="text" class="form-control" name="service" value="{{ $navigation->service }}"></td>
                        </tr>
                        <tr>
                            <td>Department Page</td>
                            <td><input type="text" class="form-control" name="department" value="{{ $navigation->department }}"></td>
                        </tr>
                        <tr>
                            <td>Faq Page</td>
                            <td><input type="text" class="form-control" name="faq" value="{{ $navigation->faq }}"></td>
                        </tr>
                        <tr>
                            <td>Testimonial Page</td>
                            <td><input type="text" class="form-control" name="testimonial" value="{{ $navigation->testimonial }}"></td>
                        </tr>
                        <tr>
                            <td>Blog Page</td>
                            <td><input type="text" class="form-control" name="blog" value="{{ $navigation->blog }}"></td>
                        </tr>
                        <tr>
                            <td>Contact Page</td>
                            <td><input type="text" class="form-control" name="contact_us" value="{{ $navigation->contact_us }}"></td>
                        </tr>
                        <tr>
                            <td>Appointment</td>
                            <td><input type="text" class="form-control" name="appointment" value="{{ $navigation->appointment }}"></td>
                        </tr>
                        <tr>
                            <td>Dashboard</td>
                            <td><input type="text" class="form-control" name="dashboard" value="{{ $navigation->dashboard }}"></td>
                        </tr>
                        <tr>
                            <td>Payment</td>
                            <td><input type="text" class="form-control" name="payment" value="{{ $navigation->payment }}"></td>
                        </tr>
                        <tr>
                            <td>Login</td>
                            <td><input type="text" class="form-control" name="login" value="{{ $navigation->login }}"></td>
                        </tr>
                        <tr>
                            <td>Register</td>
                            <td><input type="text" class="form-control" name="register" value="{{ $navigation->register }}"></td>
                        </tr>
                        <tr>
                            <td>Terms and Condition</td>
                            <td><input type="text" class="form-control" name="terms_and_condition" value="{{ $navigation->terms_and_condition }}"></td>
                        </tr>
                        <tr>
                            <td>Privacy and Policy</td>
                            <td><input type="text" class="form-control" name="privacy_policy" value="{{ $navigation->privacy_policy }}"></td>
                        </tr>
                        <tr>
                            <td>Forget Password</td>
                            <td><input type="text" class="form-control" name="forget_password" value="{{ $navigation->forget_password }}"></td>
                        </tr>
                        <tr>
                            <td>Reset Password</td>
                            <td><input type="text" class="form-control" name="reset_password" value="{{ $navigation->reset_password }}"></td>
                        </tr>








                    </table>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>




@endsection
