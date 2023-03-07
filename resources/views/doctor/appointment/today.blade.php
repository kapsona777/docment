@extends('layouts.doctor.layout')
@section('title','New Appointment')
@section('doctor-content')
    <!-- DataTales Example -->
    <div class="mb-4">
        <div class="row" id="searchSchedule">
            <div class="col-md-3">
                <select name="schedule_id" class="form-control select2" id="schedule_id">
                    <option value="">Select Schedule</option>
                    @foreach ($schedules as $schedule)
                        <option value="{{ $schedule->id }}">{{ $schedule->start_time.'-'.$schedule->end_time }}</option>
                    @endforeach
                </select>
                <p class="invalid-feedback d-none" id="schedule_error"></p>
                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}" id="doctor_id">
            </div>
            <div class="col-md-3">
               <button type="button" id="searchDoctorSchedule" class="btn btn-success">Search</button>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Today Appointment History</h6>
        </div>
        <div class="card-body" id="search-appointment">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">SN</th>
                            <th width="15%">Name</th>
                            <th width="15%">Email</th>
                            <th width="15%">Phone</th>
                            <th width="15%">Date</th>
                            <th width="25%">Time</th>
                            <th width="5%">Payment</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ ucfirst($item->user->name) }}</td>
                            <td>{{ $item->user->email }}</td>
                            <td>{{ $item->user->phone }}</td>
                            <td>{{ date('m-d-Y',strtotime($item->date)) }}</td>
                            <td>{{ strtoupper($item->schedule->start_time).'-'.strtoupper($item->schedule->end_time) }}</td>
                            <td>
                                @if ($item->payment_status==0)
                                        <span class="badge badge-danger">Pending</span>
                                    @else
                                    <span class="badge badge-success">Success</span>
                                    @endif
                            </td>
                            <td>
                                <a  href="{{ route('doctor.treatment',$item->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <script>
	(function($) {

    "use strict";
	
         // remove prescribe medicine input field row
         $(document).on('click', '#searchDoctorSchedule', function () {
            var schedule_id=$("#schedule_id").val();
            var doctor_id=$("#doctor_id").val();
            if(schedule_id){
                $('#schedule_id').removeClass('is-invalid')
                $('#schedule_error').addClass('d-none')
                $.ajax({
                    type: 'GET',
                    url: "{{ route('doctor.search.appointment') }}",
                    data:{'schedule_id':schedule_id,'doctor_id':doctor_id},
                    success: function (response) {
                        $('#search-appointment').html(response)
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });

            }else{
                toastr.error('Select Your Schedule')
                $('#schedule_id').addClass('is-invalid')
                $('#schedule_error').text('Select Your Schedule')
                $('#schedule_error').removeClass('d-none')
            }


        });

})(jQuery);
    </script>

@endsection
