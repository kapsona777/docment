@extends('layouts.doctor.layout')
@section('title','Payment')
@section('doctor-content')
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
                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}" id="doctor_id">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">To</label>
                <input type="text" id="to_date" class="form-control datepicker">
            </div>
        </div>
        <div class="col-md-3 newsearch">
            <button type="button" id="searchParticularSchedule" class="btn btn-success">Search</button>
        </div>
    </div>

    <div id="payment-history">
    <div class="row">
         <!-- Earnings (Monthly) Card Example -->
         <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Earnings (Last 30Days)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $currency->currency_icon }}{{ $payment }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Patient (Last 30Days)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $appointment }}</div>
                        </div>

                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Payment History</h6>
        </div>
        <div class="card-body" id="search-particular-appointment">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">SN</th>
                            <th width="15%">Name</th>
                            <th width="15%">Email</th>
                            <th width="15%">Phone</th>
                            <th width="15%">Date</th>
                            <th width="20%">Amount</th>
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
                            <td>{{ $currency->currency_icon }}{{ $item->appointment_fee }}</td>

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
         $(document).on('click', '#searchParticularSchedule', function () {
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
                    url: "{{ route('doctor.search.payment.history') }}",
                    data:{from_date,to_date,doctor_id},
                    success: function (response) {
                        $('#payment-history').html(response)
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
