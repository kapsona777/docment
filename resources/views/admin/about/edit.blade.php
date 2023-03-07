@extends('layouts.admin.layout')
@section('title','About')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Mission</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Vision</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active mt-5" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <form action="{{ route('admin.update.about.section',$about->id) }}" enctype="multipart/form-data" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Existing Foreground Image</label>
                                            <div><img class="w_200" src="{{ url($about->about_image) }}" alt="About Image"></div>
                                            <input type="hidden" name="old_about_image" value="{{ $about->about_image }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Change Foreground Image</label>
                                            <div><input type="file" name="image"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Existing Background Image</label>
                                            <div><img class="w_200" src="{{ url($about->background_image) }}" alt="About Background Image"></div>
                                            <input type="hidden" name="old_background_image" value="{{ $about->background_image }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Change Background Image</label>
                                            <div><input type="file" name="background_image"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="sep"></div>
                                
                                <div class="form-group">
                                    <label for="about_description">Description</label>
                                    <textarea name="about_description" id="about_description" class="summernote">{{ $about->about_description }}</textarea>
                                </div>


                                <button class="btn btn-success" type="submit">Update</button>
                            </form>
                        </div>
                        <div class="tab-pane fade mt-5" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <form action="{{ route('admin.update.mission.section',$about->id) }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Existing Image</label>
                                    <div><img class="w_200" src="{{ url($about->mission_image) }}" alt="Mission Image"></div>
                                    <input type="hidden" name="old_mission_image" value="{{ $about->mission_image }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Change Image</label>
                                    <div><input type="file" name="image"></div>
                                </div>

                                <div class="form-group">
                                    <label for="mission_description">Description</label>
                                    <textarea name="mission_description" id="mission_description" class="summernote">{{ $about->mission_description }}</textarea>
                                </div>


                                <button class="btn btn-success" type="submit">Update</button>
                            </form>
                        </div>
                        <div class="tab-pane fade mt-5" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <form action="{{ route('admin.update.vision.section',$about->id) }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Existing Image</label>
                                    <div><img class="w_200" src="{{ url($about->vision_image) }}" alt="Vision Image"></div>
                                    <input type="hidden" name="old_vision_image" value="{{ $about->vision_image }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Change Image</label>
                                    <div><input type="file" name="image"></div>
                                </div>

                                <div class="form-group">
                                    <label for="vision_description">Description</label>
                                    <textarea name="vision_description" id="vision_description" class="summernote">{{ $about->vision_description }}</textarea>
                                </div>


                                <button class="btn btn-success" type="submit">Update</button>
                            </form>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
@endsection

