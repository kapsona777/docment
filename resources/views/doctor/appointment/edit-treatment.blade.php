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
                        @if ($appointment->user->disabilities)
                        <tr>
                            <td>Disablities</td>
                            <td>{{ $appointment->user->disabilities }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td>Old Appointment History</td>
                            <td><a target="_blank" href="{{ route('doctor.old.appointment',$appointment->user_id) }}">History Here</a></td>
                        </tr>


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

        <form action="{{ route('doctor.treatment.update',$appointment->id) }}" method="POST">
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
                                    <input type="text" name="weight" value="{{ $appointment->user->weight }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Blood Pressure</label>
                                    <input type="text" name="blood_pressure" value="{{ $appointment->blood_pressure }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Pulse Rate</label>
                                    <input type="text" name="pulse_rate" value="{{ $appointment->pulse_rate }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Temperature</label>
                                    <input type="text" name="temperature" value="{{ $appointment->temperature }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Problem Description</label>
                                    <textarea name="problem_description" id="" cols="30" rows="5" class="form-control" placeholder="Type....">{{ $appointment->problem_description }}</textarea>

                                </div>
                            </div>


                            @if ($appointment->habits)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Select Habit: </label>
                                    @php
                                        $edit_habits=$appointment->habits;
                                        $edit_habits=json_decode($edit_habits);

                                    @endphp

                                    <br>
                                    @foreach ($habits as $index => $habit)
                                    @php
                                        $isSelected=false;
                                    @endphp
                                    @foreach ($edit_habits as $edit_habit)
                                        @if ($edit_habit==$habit->id)
                                            @php
                                                $isSelected=true;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <input type="checkbox" {{ $isSelected ? 'checked' : '' }}  name="habit[]" class="ml-3" value="{{ $habit->id }}"> {{ $habit->habit }}
                                    @endforeach
                                    @if ($errors->first('habit'))
                                        <p class="text-danger">{{ $errors->first('habit') }}</p>
                                    @endif

                                </div>
                            </div>
                            @else
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Select Habit: </label>
                                    <br>
                                    @foreach ($habits as $index => $habit)
                                    <input type="checkbox"  name="habit[]" class="ml-3" value="{{ $habit->id }}"> {{ $habit->habit }}
                                    @endforeach
                                </div>
                            </div>
                            @endif




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
                    @foreach ($appointment->prescribes as $index => $prescribe)
                    <div class="row mt-3 old-prescribe-{{ $prescribe->id }}">
                        <div class="col-md-2">
                            <label for="">Medicine Type</label>

                            <select name="medicine_type[]" class="form-control" id="">
                                @foreach ($medicineTypes as $type)
                                    <option {{ $prescribe->medicine_type==$type->type ? 'selected':'' }} value="{{ $type->type }}">{{ $type->type }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="">Medicine Name</label>
                            <select name="medicine_name[]" class="form-control" id="">
                                <option value="">Select Medicine</option>
                                @foreach ($medicines as $item)
                                    <option {{ $prescribe->medicine_name==$item->name ? 'selected':'' }} value="{{ $item->name }}">{{ ucwords($item->name) }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="">Dosage</label>
                            <select name="dosage[]" id="" class="form-control">
                                <option {{ $prescribe->dosage=='0-0-0' ? 'selected':'' }} value="0-0-0">0-0-0</option>
                                <option {{ $prescribe->dosage=='0-0-1' ? 'selected':'' }} value="0-0-1">0-0-1</option>
                                <option {{ $prescribe->dosage=='0-1-0' ? 'selected':'' }} value="0-1-0">0-1-0</option>
                                <option {{ $prescribe->dosage=='0-1-1' ? 'selected':'' }} value="0-1-1">0-1-1</option>
                                <option {{ $prescribe->dosage=='1-0-0' ? 'selected':'' }} value="1-0-0">1-0-0</option>
                                <option {{ $prescribe->dosage=='1-0-1' ? 'selected':'' }} value="1-0-1">1-0-1</option>
                                <option {{ $prescribe->dosage=='1-1-0' ? 'selected':'' }} value="1-1-0">1-1-0</option>
                                <option {{ $prescribe->dosage=='1-1-1' ? 'selected':'' }} value="1-1-1">1-1-1</option>

                            </select>
                        </div>
                        <div class="col-md-2" >
                            <label for="">Days</label>
                            <select name="day[]" id="" class="form-control">
                                @for($i=1;$i<=90;$i++)
                                <option value="{{ $i }}" {{ $prescribe->number_of_day==$i ? 'selected' :'' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2" >
                            <label for="">Time</label>
                            <select name="time[]" id="" class="form-control">
                                <option {{ $prescribe->time== 'After Meal' ? 'selected' : '' }} value="After Meal">After Meal</option>
                                <option {{ $prescribe->time== 'Befor Meal' ? 'selected' : '' }} value="Befor Meal">Befor Meal</option>
                            </select>
                        </div>
                        <div class="col-md-1 btn-row">
                            @if ($index==0)
                            <button id="addMedicineRow" type="button" class="btn btn-primary btn-sm ml-2"><i class="fas fa-plus" aria-hidden="true"></i></button>
                            @endif

                            @if ($index != 0)
                            <button onclick="oldPrescribeDelete({{ $prescribe->id }})" type="button" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash" aria-hidden="true"></i></button>
                            @endif

                        </div>
                    </div>
                    @endforeach
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
        @if ($appointment->advice)
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Test Description</label>
                        <textarea name="test_description" id="" cols="30" rows="3" class="form-control">{{ $appointment->advice->test_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Advice</label>
                        <textarea name="advice" id="" cols="30" rows="5" class="form-control" >{{ $appointment->advice->advice }}</textarea>
                    </div>




                </div>
            </div>
        </div>
        @else
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Test Description</label>
                        <textarea name="test_description" id="" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Advice</label>
                        <textarea name="advice" id="" cols="30" rows="5" class="form-control" ></textarea>
                    </div>




                </div>
            </div>
        </div>
        @endif

        <button type="submit" class="btn btn-success ml-3">Update Info</button>
        </form>



    </div>


    <script>
        function oldPrescribeDelete(id){
            // project demo mode check
         var isDemo="{{ env('PROJECT_MODE') }}"
         var demoNotify="{{ env('NOTIFY_TEXT') }}"
         if(isDemo==0){
             toastr.error(demoNotify);
             return;
         }
         // end

            var old_prescirbe_row="old-prescribe-"+id;
            $("."+old_prescirbe_row).addClass('d-none')
            $.ajax({
                    type: 'GET',
                    url: "{{ url('doctor/delete-appointment-prescribe/') }}"+"/"+ id,
                    success: function (response) {
                        console.log(response);


                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
        }
    </script>



@endsection
