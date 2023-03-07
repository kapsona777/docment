@extends('layouts.admin.layout')
@section('title','Settings')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Google Analytic Settings</h6>
                </div>
                <div class="card-body">                   
                    <form action="{{ route('admin.google.analytic.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Allow Google Analytic</label>
                            <select name="google_analytic" id="" class="form-control">
                                <option {{ $setting->google_analytic==1 ? 'selected':'' }} value="1">Active</option>
                                <option {{ $setting->google_analytic==0 ? 'selected':'' }} value="0">In-active</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="google_analytic_code">Analytic Tracking Id</label>
							<input type="text" class="form-control" name="google_analytic_code" id="google_analytic_code" value="{{ $setting->google_analytic_code }}">
                        </div>
                        <button type="submit" class="btn btn-success">Save Info</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
