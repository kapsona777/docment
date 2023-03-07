@extends('layouts.admin.layout')
@section('title','Profile Image')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profile Image</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <form action="{{ route('admin.default.profile') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <td>Default Profile Image</td>
                            <td><img width="100px" src="{{ $banner->default_profile ? url($banner->default_profile) :'' }}" alt="default_profile_image"></td>
                            <td><input required type="file" class="form-control" name="default_profile" value=""></td>
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
