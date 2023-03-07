@extends('layouts.admin.layout')
@section('title','Patient')
@section('admin-content')

<style>
    .newsearch button{
        margin-top: 30px;
    }
</style>
    <!-- DataTales Example -->
    <div class="row mb-2"">
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
        <div class="col-md-3 newsearch">
            <button type="button" id="searchPatient" class="btn btn-success">Search</button>

        </div>
    </div>
    <div id="patient-box">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Patient Table <button class="btn btn-success btn-sm" onclick="printReport()"><i class="fas fa-print    "></i></button></h6>
        </div>
        <div class="card-body" id="search-appointment">
            <div class="table-responsive printArea">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">SN</th>
                            <th width="15%">Name</th>
                            <th width="10%">Email</th>
                            <th width="10%">Appointment Qty</th>
                            <th width="15%">Reg. Date</th>
                            <th width="15%">Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patients as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ ucfirst($item->name) }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->appointment->count() }}</td>
                            <td>{{ $item->created_at->format('m-d-Y') }}</td>


                            <td>
                                @if ($item->status==1)
                                    <a href="" onclick="patientStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="In-Active" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="patientStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="Active" data-off="In-Active" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a  href="{{ route('admin.patient.show',$item->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                <a data-toggle="modal" data-target="#delete-patient-{{ $item->id }}"  class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

 <!-- Modal -->
 @foreach ($patients as $index => $item)
 <div class="modal fade" id="delete-patient-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
                 <div class="modal-header">
                         <h5 class="modal-title">Delete Patient</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                     </div>
             <div class="modal-body">
                 <div class="container-fluid">
                     Are You Sure?
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <a href="{{ route('admin.patient.delete',$item->id) }}" class="btn btn-danger">Yes, Delete</a>
             </div>
         </div>
     </div>
 </div>

@endforeach

    <script>
	(function($) {

    "use strict";
        // remove prescribe medicine input field row
        $(document).on('click', '#searchPatient', function () {
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
                   url: "{{ route('admin.patient.search') }}",
                   data:{from_date,to_date},
                   success: function (response) {
                       $('#patient-box').html(response)
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

       function patientStatus(id){

           // project demo mode check
         var isDemo="{{ env('PROJECT_MODE') }}"
         var demoNotify="{{ env('NOTIFY_TEXT') }}"
         if(isDemo==0){
             toastr.error(demoNotify);
             return;
         }
         // end


            $.ajax({
                type:"get",
                url:"{{url('/admin/patient-status/')}}"+"/"+id,
                success:function(response){
                   toastr.success(response)
                },
                error:function(err){
                    console.log(err);

                }
            })
        }

   </script>
@endsection

