@extends('layouts.admin.layout')
@section('title','Doctor Page')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Manage Doctor Page</h6>
                </div>
                <div class="card-body">
                   
                    <form action="{{ route('admin.doctor.page.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="doctor_title" class="form-control" value="{{ $page->doctor_title }}" >
                        </div>
                        <div class="form-group">
                            <label for="home_meta_description">Meta Description</label>
                            <textarea name="doctor_meta_description" id="home_meta_description" cols="30" rows="5" class="form-control" >{{ $page->doctor_meta_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="show_navbar">Show Navbar?</label>
                            <select name="show_navbar" id="show_navbar" class="form-control">
                                <option {{ $navigation->show_doctor==1 ? 'selected':'' }} value="1">Yes</option>
                                <option {{ $navigation->show_doctor==0 ? 'selected':'' }} value="0">No</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
