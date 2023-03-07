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
