@extends('layouts.admin.layout')
@section('title','Blog Image')
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.blog.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> All Blog </a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Blog Images</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered mb-5">
                        <tr>
                            <td>Thumbnail Image</td>
                            @if ($blog->thumbnail_image)
                            <td><img src="{{ url($blog->thumbnail_image) }}" alt="Blog Thumbnail Image" width="100px"></td>
                            @else
                            <td><img src="" alt="Blog Thumbnail Image" width="100px"></td>
                            @endif
                            <td><a href="{{ route('admin.delete.blog.thumbnail',$blog->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash" aria-hidden="true"></i></a></td>
                        </tr>
                        <tr>
                            <td>Feature Image</td>
                            @if ($blog->feature_image)
                            <td><img src="{{ url($blog->feature_image) }}" alt="Blog Feature Image" width="100px"></td>
                            @else
                            <td><img src="" alt="Blog Feature Image" width="100px"></td>
                            @endif

                            <td><a href="{{ route('admin.delete.blog.feature',$blog->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash" aria-hidden="true"></i></a></td>
                        </tr>

                    </table>
                    <div class="my-5"></div>
                    <form action="{{ route('admin.blog.thumbnail',$blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Thumbnail Image</label>
                            <input type="file" name="thumbnail_image" class="form-control">
                            <input type="hidden" name="old_thumbnail" value="{{ $blog->thumbnail_image }}" class="form-control">
                            @if(Session::has('thumbnail_error'))
                                <span class="text-danger">{{ Session::get('thumbnail_error') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success">Save Thumbnail Image</button>
                    </form>

                    <div class="my-5"></div>
                    <form action="{{ route('admin.blog.feature',$blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Feature Image</label>
                            <input type="file" name="feature_image" class="form-control">
                            <input type="hidden" name="old_feature" value="{{ $blog->feature_image }}">
                            @if(Session::has('feature_error'))
                                <span class="text-danger">{{ Session::get('feature_error') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success">Save Feature Image</button>
                    </form>


                </div>
            </div>
        </div>
    </div>

@endsection
