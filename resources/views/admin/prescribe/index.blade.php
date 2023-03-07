@extends('layouts.admin.layout')
@section('title','Prescription')
@section('admin-content')
<style>
    .newsearch button{
        margin-top: 30px;
    }
</style>
    <!-- DataTales Example -->
    <div class="row mb-2" id="searchSchedule">
        <div class="col-md-3">
            <div class="form-group">
                <label for="">From</label>
                <input type="text" class="form-control datepicker" id="from_date">
                <p class="invalid-feedback d-none" id="from_date_error"></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">To</label>
                <input type="text" id="to_date" class="form-control datepicker">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Doctor</label>
                <select name="doctor_id" id="doctor_id" class="form-control select2">
                    <option value="">Select Doctor</option>
                    @foreach ($doctors as $item)
                    <option value="{{ $item->id }}">{{ ucwords($item->name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3 newsearch">
            <button type="button" id="searchPrescribe" class="btn btn-success">Search</button>
        </div>
    </div>
    <div id="prescribe-box">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Prescription History <button class="btn btn-success btn-sm" onclick="printReport()"><i class="fas fa-print    "></i></button></h6>
        </div>
        <div class="card-body" id="search-appointment">
            <div class="table-responsive printArea">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">SN</th>
                            <th width="15%">Name</th>
                            <th width="15%">Email</th>
                            <th width="15%">Doctor</th>
                            <th width="15%">Date</th>
                            <th width="25%">Time</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ ucfirst($item->user->name) }}</td>
                            <td>{{ $item->user->email }}</td>
                            <td>{{ $item->doctor->name }}</td>
                            <td>{{ date('m-d-Y',strtotime($item->date)) }}</td>
                            <td>{{ strtoupper($item->schedule->start_time).'-'.strtoupper($item->schedule->end_time) }}</td>

                            <td>
                                <a  href="{{ route('admin.prescribe.show',$item->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


    <script>
	(function($) {

    "use strict";
        // remove prescribe medicine input field row
        $(document).on('click', '#searchPrescribe', function () {
           var from_date=$("#from_date").val();
           var doctor_id=$("#doctor_id").val();
           if(from_date){
               $('#from_date').removeClass('is-invalid')
               $('#from_date_error').addClass('d-none')
               var to_date=$("#to_date").val();
               if(to_date) to_date=to_date;
               else to_date=from_date;
               $.ajax({
                   type: 'GET',
                   url: "{{ route('admin.prescribe.search') }}",
                   data:{from_date,to_date,doctor_id},
                   success: function (response) {
                       $('#prescribe-box').html(response)
                   },
                   error: function(err) {
                       console.log(err);
                   }
               });

           }else{
               toastr.error('From Date Is Required')
               $('#from_date').addClass('is-invalid')
               $('#from_date_error').text('From Date Is Required')
               $('#from_date_error').removeClass('d-none')
           }


       });
	   })(jQuery);

   </script>
@endsection

