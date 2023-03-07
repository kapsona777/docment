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
                        <th width="15%">Email</th>
                        <th width="15%">Appointment Qty</th>
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
                            @if ($item->status==0)
                                    <span class="badge badge-danger">Pending</span>
                                @else
                                <span class="badge badge-success">Success</span>
                                @endif
                        </td>
                        <td>
                            <a  href="{{ route('admin.patient.show',$item->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
