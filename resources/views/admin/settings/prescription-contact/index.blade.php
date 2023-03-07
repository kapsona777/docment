@extends('layouts.admin.layout')
@section('title','Prescription Contact')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Prescription Contact</h6>
                </div>
                <div class="card-body">
                   
                    <form action="{{ route('admin.prescription.contact.update') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="prescription_phone">Phone</label>
                           <input type="text" name="phone" value="{{ $setting->prescription_phone }}"  class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="prescription_email">Email</label>
                           <input type="text" name="email" value="{{ $setting->prescription_email }}"  class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Save Info</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
