@extends('layouts.admin.layout')
@section('title','Day')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Day Table</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th >Default Day</th>
                            <th >Custom Day</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($days as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->day }}</td>
                            <td>{{ $item->custom_day }}</td>
                            <td>
                                <a data-toggle="modal" data-target="#edit-day-{{ $item->id }}" class="btn btn-primary btn-sm"><i class="fas fa-edit    "></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @foreach ($days as $item)
    <!-- Modal -->
    <div class="modal fade" id="edit-day-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Day Form</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('admin.day.update',$item->id) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="">Default Day</label>
                                <input type="text" value="{{ $item->day }}" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Custom Day</label>
                                <input type="text" value="{{ $item->custom_day }}" name="custom_day" class="form-control" required>
                                
                            </div>

                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection
