@extends('layouts.doctor.layout')
@section('title','Treatment')
@section('doctor-content')
<style>
    .btn-row button{
        margin-top: 30px;
    }

</style>
    <!-- Appointment Details -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Patient Info</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Name</td>
                            <td>{{ ucwords($appointment->user->name) }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $appointment->user->email }}</td>
                        </tr>
                        <tr>
                            <td>Age</td>
                            <td>{{ $appointment->user->age }}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>{{ $appointment->user->gender }}</td>
                        </tr>
                        <tr>
                            <td>Old Appointment History</td>
                            <td><a href="{{ route('doctor.old.appointment',$appointment->user_id) }}">History Here</a></td>
                        </tr>

                        @if ($appointment->user->disabilities)
                        <tr>
                            <td>Disablities</td>
                            <td>{{ $appointment->user->disabilities }}</td>
                        </tr>
                        @endif


                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Appointment Info</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Date</td>
                            <td>{{ $appointment->date }}</td>
                        </tr>
                        <tr>
                            <td>Time</td>
                            <td>{{ strtoupper($appointment->schedule->start_time).'-'.strtoupper($appointment->schedule->end_time) }}</td>
                        </tr>
                        <tr>
                            <td>Appointment Fee</td>
                            <td>{{ $currency->currency_icon }}{{ $appointment->appointment_fee }}</td>
                        </tr>
                        <tr>
                            <td>Already Treated</td>
                            <td>
                                @if ($appointment->already_treated==1)
                                    <span class="badge badge-success">Yes</span>
                                @else
                                    <span class="badge badge-danger">No</span>
                                @endif
                            </td>
                        </tr>


                    </table>
                </div>
            </div>
        </div>

        <form action="{{ route('doctor.treatment.store',$appointment->id) }}" method="POST">
        @csrf
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Patient Physical Info</h6>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Weight</label>
                                    <input type="text" name="weight" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Blood Pressure</label>
                                    <input type="text" name="blood_pressure" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Pulse Rate</label>
                                    <input type="text" name="pulse_rate" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Temperature</label>
                                    <input type="text" name="temperature" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Problem Description</label>
                                    <textarea name="problem_description" id="" cols="30" rows="5" class="form-control"></textarea>
                                    
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Select Habit: </label>
                                    <br>
                                    @foreach ($habits as $habit)
                                        <input type="checkbox" name="habit[]" id="" class="ml-3" value="{{ $habit->id }}"> {{ $habit->habit }}
                                    @endforeach                                   
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Prescribe</h6>
                </div>
                <div class="card-body" id="medicineRow">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">Type</label>
                            <select name="medicine_type[]" class="form-control" id="">
                                @foreach ($medicineTypes as $type)
                                    <option value="{{ $type->type }}">{{ $type->type }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="">Medicine Name</label>
                            <select name="medicine_name[]" class="form-control" id="">
                                <option value="">Select Medicine</option>
                                @foreach ($medicines as $item)
                                    <option value="{{ $item->name }}">{{ ucwords($item->name) }}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="">Dosage</label>
                            <select name="dosage[]" id="" class="form-control">
                                <option value="0-0-0">0-0-0</option>
                                <option value="0-0-1">0-0-1</option>
                                <option value="0-1-0">0-1-0</option>
                                <option value="0-1-1">0-1-1</option>
                                <option value="1-0-0">1-0-0</option>
                                <option value="1-0-1">1-0-1</option>
                                <option value="1-1-0">1-1-0</option>
                                <option value="1-1-1">1-1-1</option>

                            </select>
                        </div>
                        <div class="col-md-2" >
                            <label for="">Days</label>
                            <select name="day[]" id="" class="form-control">
                                @for($i=1;$i<=90;$i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2" >
                            <label for="">Time</label>
                            <select name="time[]" id="" class="form-control">
                                <option value="After Meal">After Meal</option>
                                <option value="Befor Meal">Befor Meal</option>
                            </select>
                        </div>

                        <div class="col-md-1 btn-row">
                            <button id="addMedicineRow" type="button" class="btn btn-primary btn-sm ml-2"><i class="fas fa-plus" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>

                <div id="hiddenPrescribeRow" class="vh">
                    <div id="delete-prescribe-row">
                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label for="">Medicine Type</label>
                                <select name="medicine_type[]" class="form-control" id="">
                                    @foreach ($medicineTypes as $type)
                                        <option value="{{ $type->type }}">{{ $type->type }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="">Medicine Name</label>
                                <select name="medicine_name[]" class="form-control" id="">
                                    <option value="">Select Medicine</option>
                                    @foreach ($medicines as $item)
                                        <option value="{{ $item->name }}">{{ ucwords($item->name) }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="">Dosage</label>
                                <select name="dosage[]" id="" class="form-control">
                                    <option value="0-0-0">0-0-0</option>
                                    <option value="0-0-1">0-0-1</option>
                                    <option value="0-1-0">0-1-0</option>
                                    <option value="0-1-1">0-1-1</option>
                                    <option value="1-0-0">1-0-0</option>
                                    <option value="1-0-1">1-0-1</option>
                                    <option value="1-1-0">1-1-0</option>
                                    <option value="1-1-1">1-1-1</option>

                                </select>
                            </div>
                            <div class="col-md-2" >
                                <label for="">Days</label>
                                <select name="day[]" id="" class="form-control">
                                    @for($i=1;$i<=90;$i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>

                            </div>
                            <div class="col-md-2" >
                                <label for="">Time</label>
                                <select name="time[]" id="" class="form-control">
                                    <option value="After Meal">After Meal</option>
                                    <option value="Befor Meal">Befor Meal</option>
                                </select>
                            </div>
                            <div class="col-md-1 btn-row">
                                <button type="button" id="removePrescribeRow" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Advice</h6>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="">Test Description</label>
                        <textarea name="test_description" id="" cols="30" rows="3" class="form-control" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Advice</label>
                        <textarea name="advice" id="" cols="30" rows="5" class="form-control" ></textarea>
                    </div>




                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success ml-3">Save Info</button>
        </form>



    </div>





@endsection
