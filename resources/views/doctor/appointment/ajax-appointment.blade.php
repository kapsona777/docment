@if ($appointments->count()!=0)
<div class="table-responsive">
    <table class="table table-bordered" width="100%" cellspacing="0">
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
@else
    <h3 class="text-danger text-center">Appointment Not Found</h3>
@endif
