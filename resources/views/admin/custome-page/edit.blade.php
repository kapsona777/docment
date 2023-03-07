@extends('layouts.admin.layout')
@section('title','Custom Page')
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.custom-page.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> All Custom Page </a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Custom Page Form</h6>
                </div>
                <div class="card-body">
                   
                    <form action="{{ route('admin.custom-page.update',$page->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="page_name">Page Name</label>
                            <input type="text" name="page_name" class="form-control" id="page_name" value="{{ $page->page_name }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="summernote" id="description" name="description">{{ $page->description }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ $page->status==1?'selected':'' }} value="1">Active</option>
                                        <option {{ $page->status==0?'selected':'' }} value="0">In-Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="seo_title">Seo Title</label>
                            <input type="text" name="seo_title" class="form-control" id="seo_title" value="{{ $page->seo_title }}">
                        </div>
                        <div class="form-group">
                            <label for="seo_description">Seo Description</label>
                            <textarea name="seo_description" id="seo_description" cols="30" rows="3" class="form-control">{{ $page->seo_description }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
