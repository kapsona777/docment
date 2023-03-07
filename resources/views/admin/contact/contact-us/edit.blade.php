@extends('layouts.admin.layout')
@section('title','Contact-Us')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Top Bar Contact</h6>
                </div>
                <div class="card-body">
                   
                    <form action="{{ route('admin.contact-us.update',$contact->id) }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" id="email"  value="{{ $contact->email }}">
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="phone"  value="{{ $contact->phone }}">
                                    
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" name="facebook" class="form-control" id="facebook"  value="{{ $contact->facebook }}">
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" name="twitter" class="form-control" id="twitter"  value="{{ $contact->twitter }}">
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pinterest">Pinterest</label>
                                    <input type="text" name="pinterest" class="form-control" id="pinterest"  value="{{ $contact->pinterest }}">
                                    
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="linkedin">LinkedIn</label>
                                    <input type="text" name="linkedin" class="form-control" id="linkedin"  value="{{ $contact->linkedin }}">
                                   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="youtube">YouTube</label>
                                    <input type="text" name="youtube" class="form-control" id="youtube"  value="{{ $contact->youtube }}">
                                    
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-success">Update Contact</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
