@extends('layouts.admin.layout')
@section('title','Blog Create')
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.admin-list.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> All Admin </a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Admin</h6>
                </div>
                <div class="card-body">
                   
                    <form action="{{ route('admin.admin-list.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                         <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">In-Active</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Save Admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
