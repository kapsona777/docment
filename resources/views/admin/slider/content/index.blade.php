@extends('layouts.admin.layout')
@section('title','Slider Content')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Slider Content</h6>
                </div>
                <div class="card-body">
                   
                    <form action="{{ route('admin.slider.content.update',$content->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Slider Heading</label>
                            <input type="text" name="slider_heading" class="form-control" value="{{ $content->slider_heading }}">
                        </div>
                        <div class="form-group">
                            <label for="">Slider Description</label>
                            <textarea name="slider_description" id="" cols="30" rows="5" class="form-control">{{ $content->slider_description }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Update Info</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
