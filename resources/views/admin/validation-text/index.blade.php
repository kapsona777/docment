@extends('layouts.admin.layout')
@section('title','Validation Errors')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Validation Errors</h6>
                </div>
                <div class="card-body">
                    
                    <form action="{{ route('admin.update.validation.text') }}" method="post">
                    @csrf
                    <table class="table table-bordered">

                        <tr>
                            <td>The Name Field Is Required</td>
                            <td><input type="text" name="name" value="{{ $text->name }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>The Email Field Is Required</td>
                            <td><input type="text" name="email" value="{{ $text->email }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Email Already Exist</td>
                            <td><input type="text" name="unique_email" value="{{ $text->unique_email }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>The email must be a valid email address.</td>
                            <td><input type="text" name="valid_email" value="{{ $text->valid_email }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>The Password Field Is Required</td>
                            <td><input type="text" name="password" value="{{ $text->password }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Confirmation Password does not match</td>
                            <td><input type="text" name="confirm_password" value="{{ $text->confirm_password }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>The password must be at least 6 characters.</td>
                            <td><input type="text" name="minimum_password" value="{{ $text->minimum_password }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>The Phone Field Is Required</td>
                            <td><input type="text" name="phone" value="{{ $text->phone }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>The Subject Field Is Required</td>
                            <td><input type="text" name="subject" value="{{ $text->subject }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>The Message Field Is Required</td>
                            <td><input type="text" name="message" value="{{ $text->message }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>The Comment Field Is Required</td>
                            <td><input type="text" name="comment" value="{{ $text->comment }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>The Transaction Info Field Is Required</td>
                            <td><input type="text" name="transaction_info" value="{{ $text->transaction_info }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>The Age Field Is Required</td>
                            <td><input type="text" name="age" value="{{ $text->age }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>The Occupation Field Is Required</td>
                            <td><input type="text" name="occupation" value="{{ $text->occupation }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>The gender Field Is Required</td>
                            <td><input type="text" name="gender" value="{{ $text->gender }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>The address Field Is Required</td>
                            <td><input type="text" name="address" value="{{ $text->address }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>The country Field Is Required</td>
                            <td><input type="text" name="country" value="{{ $text->country }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>The city Field Is Required</td>
                            <td><input type="text" name="city" value="{{ $text->city }}" class="form-control"></td>
                        </tr>






















                    </table>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
