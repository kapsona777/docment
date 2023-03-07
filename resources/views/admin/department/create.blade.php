@extends('layouts.admin.layout')
@section('title','Department Create')
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.department.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> All Departments </a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Department Form</h6>
                </div>
                <div class="card-body">
                   
                    <form action="{{ route('admin.department.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="thumbnail_image">Thumbnail Image</label>
                                    <input type="file" class="form-control" name="thumbnail_image" id="thumbnail_image">
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="summernote" id="description" name="description"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">In-Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="show_home_page">Show Home Page</label>
                                    <select name="show_homepage" id="show_home_page" class="form-control">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="seo_title">Seo Title</label>
                            <input type="text" name="seo_title" class="form-control" id="seo_title" >
                        </div>
                        <div class="form-group">
                            <label for="seo_description">Seo Description</label>
                            <textarea name="seo_description" id="seo_description" cols="30" rows="3" class="form-control" ></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Save Department</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
