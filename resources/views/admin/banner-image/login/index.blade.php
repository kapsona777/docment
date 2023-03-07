@extends('layouts.admin.layout')
@section('title','Login Image')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Login Image</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <form action="{{ route('admin.admin_login.banner') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>Admin Login</td>
                            <td><img width="100px" src="{{ $banner->admin_login ? url($banner->admin_login) :'' }}" alt="admin_login banner"></td>
                            <td><input required type="file" class="form-control" name="admin_login" value=""></td>
                            <td>
                                <button type="submit" class="btn btn-success">Update</button>
                            </td>
                        </form>
                        </tr>
                        <tr>
                            <form action="{{ route('admin.doctor_login.banner') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>Doctor Login</td>
                            <td><img width="100px" src="{{ $banner->doctor_login ? url($banner->doctor_login) :'' }}" alt="doctor_login banner"></td>
                            <td><input required type="file" class="form-control" name="doctor_login" value=""></td>
                            <td>
                                <button type="submit" class="btn btn-success">Update</button>
                            </td>
                        </form>
                        </tr>


                    </table>

                </div>
            </div>
        </div>
    </div>




@endsection
