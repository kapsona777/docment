@extends('layouts.admin.layout')
@section('title','Patient')
@section('admin-content')
    <h1><a href="{{ route('admin.patients') }}" class="btn btn-success"><i class="fas fa-list"></i> View Patients</a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body" id="search-appointment">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>Image</td>
                            <td>
                                @if ($patient->image)
                                <img class="img-thumbnail" src="{{ url($patient->image) }}" alt="Patient Image" width="100px">
                                @else
                                <img class="img-thumbnail" src="{{ $user_image->default_profile ? url($user_image->default_profile) :'' }}" alt="Patient Image" width="100px">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{ $patient->name }}</td>
                        </tr>

                        <tr>
                            <td>Email</td>
                            <td>{{ $patient->email }}</td>
                        </tr>
                        <tr>
                            <td>Total Appointment</td>
                            <td>{{ $patient->appointment->count() }}</td>
                        </tr>

                        <tr>
                            <td>Phone</td>
                            <td>{{ $patient->Phone }}</td>
                        </tr>
                        <tr>
                            <td>Guardian Name</td>
                            <td>{{ $patient->guardian_name }}</td>
                        </tr>
                        <tr>
                            <td>Guardian Phone</td>
                            <td>{{ $patient->guardian_phone }}</td>
                        </tr>
                        <tr>
                            <td>Occupation</td>
                            <td>{{ $patient->occupation }}</td>
                        </tr>
                        <tr>
                            <td>Age</td>
                            <td>{{ $patient->age }}</td>
                        </tr>
                        <tr>
                            <td>Date Of Birth</td>
                            <td>{{ $patient->date_of_birth }}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>{{ $patient->gender }}</td>
                        </tr>
                        <tr>
                            <td>weight</td>
                            <td>{{ $patient->weight }}</td>
                        </tr>
                        <tr>
                            <td>Height</td>
                            <td>{{ $patient->height }}</td>
                        </tr>
                        <tr>
                            <td>Disability</td>
                            <td>{{ $patient->disablities }}</td>
                        </tr>
                        <tr>
                            <td>Helt Insurance Number</td>
                            <td>{{ $patient->helth_insurance_number }}</td>
                        </tr>
                        <tr>
                            <td>Helth Card Number</td>
                            <td>{{ $patient->helth_card_number }}</td>
                        </tr>
                        <tr>
                            <td>Helth Card Provider</td>
                            <td>{{ $patient->health_card_provider }}</td>
                        </tr>




                    </thead>

                </table>
            </div>
        </div>
    </div>
@endsection

