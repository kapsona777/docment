@extends('layouts.admin.layout')
@section('title','Subscriber')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Subscriber Table</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscribers as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                @if ($item->status)
                                    <span class="badge badge-success">Verified</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.subscriber.delete',$item->id) }}" onclick="return confirm('Are you sure want to delete this Subscriber??')"class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

