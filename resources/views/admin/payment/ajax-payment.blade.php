<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Payment History
            <button class="btn btn-success btn-sm" onclick="printReport()"><i class="fas fa-print    "></i></button>
        </h6>
    </div>
    <div class="card-body" id="search-appointment">
        <div class="table-responsive printArea">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">SN</th>
                        <th width="15%">Name</th>
                        <th width="15%">Email</th>
                        <th width="15%">Phone</th>
                        <th width="5%">Payment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $index => $doctor)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{ ucfirst($doctor->name) }}</td>
                        <td>{{ $doctor->email }}</td>
                        <td>{{ $doctor->phone }}</td>
                        @php
                            $total=$appointments->where('doctor_id',$doctor->id)->sum('appointment_fee')
                        @endphp
                        <td>
                            {{ $currency->currency_icon }}{{ $total }}
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
