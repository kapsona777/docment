@extends('layouts.admin.layout')
@section('title','Department')
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.department.create') }}" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> New Departments </a></h1>

    <!-- department table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Departments Table</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">SN</th>
                            <th width="25%">Name</th>
                            <th width="25%">Slug</th>
                            <th width="10%">Status</th>
                            <th width="15%">Others</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>
                                @if ($item->status==1)
                                    <a href="" onclick="departmentStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="In-Active" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="departmentStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="Active" data-off="In-Active" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.department.images',$item->id) }}"> Manage Image</a>
                                <a href="{{ route('admin.department-video.index') }}"> Manage Video</a>
                                <a href="{{ route('admin.faq.by.department',$item->id) }}"> Manage FAQ</a>
                            </td>
                            <td>
                                <a href="{{ route('admin.department.edit',$item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit    "></i></a>
                                <a target="_blank" href="{{ url('department-details/'.$item->slug) }}" class="btn btn-success btn-sm"><i class="fas fa-eye    "></i></a>
                                @php
                                    $count=$doctors->where('department_id',$item->id)->count();
                                @endphp
                                @if ($count == 0)
                                <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $item->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i></a>
                                @endif




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
            $("#deleteForm").attr("action",'{{ url("admin/department/") }}'+"/"+id)
        }

        function departmentStatus(id){


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
                url:"{{url('/admin/department-status/')}}"+"/"+id,
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
