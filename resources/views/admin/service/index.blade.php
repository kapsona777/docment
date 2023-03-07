@extends('layouts.admin.layout')
@section('title','Service')
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.service.create') }}" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> New Service </a></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Services</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">SN</th>
                            <th width="20%">Name</th>
                            <th width="20%">Slug</th>
                            <th width="15%">Others</th>
                            <th width="10%">Status</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->header }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>
                                <a href="{{ route('admin.service.images',$item->id) }}">Manage Image</a>
                                <a href="{{ route('admin.service-video.index') }}">Manage Video</a>
                                <a href="{{ route('admin.faq.by.service',$item->id) }}">Manage FAQ</a>
                            </td>

                            <td>
                                @if ($item->status==1)
                                <a href="" onclick="serviceStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="In-Active" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="serviceStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="Active" data-off="In-Active" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.service.edit',$item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <a target="_blank" href="{{ url('service-details/'.$item->slug) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $item->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i></a>

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/service/") }}'+"/"+id)
        }

        function serviceStatus(id){
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
                url:"{{url('/admin/service-status/')}}"+"/"+id,
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
