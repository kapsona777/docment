@extends('layouts.admin.layout')
@section('title','Theme Color')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Theme Color</h6>
                </div>
                <div class="card-body">
                   
                    <form action="{{ route('admin.theme-color.update') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="theme_color_one">Theme Color One : </label>
                            <input type="color" id="theme_color_one" name="theme_one" value="{{ $setting->theme_one }}">
                        </div>
                        <div class="form-group">
                            <label for="theme_color_two">Theme Color Two : </label>
                            <input type="color" id="theme_color_two" name="theme_two" value="{{ $setting->theme_two }}">
                        </div>


                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
