@extends('layouts.doctor.layout')
@section('title','Doctor Profile')
@section('doctor-content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Change Password</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active mt-5" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <form action="{{ route('doctor.update.profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Old Image:</label>
                                <img src="{{ url($doctor->image) }}" alt="doctor image" width="100px" class="img-thumbnail ml-3">
                            </div>
                            <div class="form-group">
                                <label for="image">New Image</label>
                                <input type="file" class="form-control-file" name="image" id="image">
                                <input type="hidden" name="old_image" value="{{ $doctor->image }}">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{ ucfirst($doctor->name) }}">
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" value="{{ $doctor->email }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" class="form-control" id="phone" value="{{$doctor->phone }}">
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="designations">Designations</label>
                                        <input type="text" name="designations" class="form-control" id="designations"  value="{{ $doctor->designations }}">
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="appointment_fee">Appointment Fee</label>
                                        <input type="text" class="form-control" id="appointment_fee" value="{{ $doctor->fee }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <input type="text" value="{{ $doctor->department->name }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="location">Chamber Location</label>
                                        <input type="text" value="{{ $doctor->location->location }}" readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="facebook">Facebook</label>
                                        <input type="text" class="form-control" name="facebook" id="facebook" value="{{ $doctor->facebook }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="twitter">Twitter</label>
                                        <input type="text" class="form-control" name="twitter" id="twitter" value="{{ $doctor->twitter }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="linkedin">LinkedIn</label>
                                        <input type="text" class="form-control" name="linkedin" id="linkedin" value="{{ $doctor->linkedin }}">
                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="about">About</label>
                                        <textarea name="about" id="about" cols="30" rows="5" class="form-control">{{ $doctor->about }}</textarea>
                                        
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" id="address" class="summernote">{{ $doctor->address }}</textarea>
                                       
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="educations">Educations</label>
                                        <textarea name="educations" id="educations" class="summernote">{{ $doctor->educations }}</textarea>
                                        
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="experiences">Experiences</label>
                                        <textarea name="experiences" id="experiences" class="summernote">{{ $doctor->experience }}</textarea>
                                        
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="qualifications">Qualifications</label>
                                        <textarea name="qualifications" id="qualifications" class="summernote">{{ $doctor->qualifications }}</textarea>
                                        
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-success">Update Doctor</button>
                        </form>
                    </div>
                    <div class="tab-pane fade mt-5" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="{{ route('doctor.change.password') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">New Password</label>
                                        <input type="password" name="password" class="form-control">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-success">Change Password</button>
                                </div>
                            </div>

                        </form>
                    </div>

                  </div>
            </div>
        </div>
    </div>
</div>

@endsection
