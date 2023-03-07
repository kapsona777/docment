@extends('layouts.admin.layout')
@section('title','Privacy and Condition')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Privacy and Condition Form</h6>
                </div>
                <div class="card-body">
                   
                    <form action="{{ route('admin.terms-privacy.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="terms_condition">Terms and Condition</label>
                            <textarea class="summernote" id="terms_condition" name="terms_condition"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="privacy_policy">Privacy and Policy</label>
                            <textarea class="summernote" id="privacy_policy" name="privacy_policy"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Save </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
