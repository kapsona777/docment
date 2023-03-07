@extends('layouts.admin.layout')
@section('title','Doctor')
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.doctor.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> All Doctors </a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Doctor Form</h6>
                </div>
                <div class="card-body">
                   
                    <form action="{{ route('admin.doctor.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name *</label>
                                    <input type="text" name="name" class="form-control" id="name"  value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="text" name="email" class="form-control" id="email"  value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone *</label>
                                    <input type="text" name="phone" class="form-control" id="phone"  value="{{ old('phone') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password *</label>
                                    <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="designations">Designations *</label>
                                    <input type="text" name="designations" class="form-control" id="designations" value="{{ old('designations') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Image *</label>
                                    <input type="file" name="image" class="form-control" id="image" >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="appointment_fee">Appointment Fee *</label>
                                    <input type="text" name="appointment_fee" class="form-control" id="appointment_fee"  value="{{ old('appointment_fee') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department">Department *</label>
                                    <select name="department" id="department" class="form-control">
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $item)
                                        <option {{ old('department')==$item->id? 'selected' : ''}} value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="location">Chamber Location *</label>
                                    <select name="location" id="location" class="form-control">
                                        <option value="">Select Location</option>
                                        @foreach ($locations as $item)
                                        <option {{ old('location')==$item->id? 'selected' : ''}} value="{{ $item->id }}">{{ ucfirst($item->location) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" class="form-control" name="facebook" id="facebook" value="{{ old('facebook') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" class="form-control" name="twitter" id="twitter"  value="{{ old('twitter') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="linkedin">LinkedIn</label>
                                    <input type="text" class="form-control" name="linkedin" id="linkedin">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="about">About</label>
                                    <textarea name="about" id="about" cols="30" rows="5" class="form-control">{{ old('about') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address" class="summernote">{{ old('address') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="educations">Educations</label>
                                    <textarea name="educations" id="educations" class="summernote">{{ old('educations') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="experiences">Experiences</label>
                                    <textarea name="experiences" id="experiences" class="summernote">{{ old('experiences') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="qualifications">Qualifications</label>
                                    <textarea name="qualifications" id="qualifications" class="summernote">{{ old('qualifications') }}</textarea>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status *</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">In-Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="show_homepage">Show HomePage *</label>
                                    <select name="show_homepage" id="show_homepage" class="form-control">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="seo_title">Seo Title</label>
                                    <input type="text" name="seo_title" class="form-control" id="seo_title" value="{{ old('seo_title') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="seo_description">Seo Description</label>
                                    <textarea name="seo_description" id="seo_description" cols="30" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-success">Save Doctor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
