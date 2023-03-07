@extends('layouts.admin.layout')
@section('title','Work Section')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Work Section</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.work.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="image">Background Image</label>
                            <input type="file" name="image" class="form-control" id="image">
                            
                        </div>
                        <div class="form-group">
                            <label for="video">Video Link</label>
                            <input type="text" name="video" class="form-control" id="video"  value="{{ old('video') }}">
                            
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
                            
                        </div>

                        <div class="form-group">
                            <label for="description">Title</label>
                            <textarea name="description" id="description" cols="30" rows="3" class="form-control">{{ old('description') }}</textarea>

                            
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
