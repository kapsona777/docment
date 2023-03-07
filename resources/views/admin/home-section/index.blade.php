@extends('layouts.admin.layout')
@section('title','Home Section')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Home Sections Table</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">SN</th>
                            <th width="20%">Section Name</th>
                            <th width="20%">First Header</th>
                            <th width="15%">Second Header</th>
                            <th width="15%">Content Quantity</th>
                            <th width="10%">Show Hompage</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sections as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ ucwords($item->section_name) }}</td>
                            <td>{{ ucwords($item->first_header) }}</td>
                            <td>{{ ucwords($item->second_header) }}</td>
                            <td>{{ $item->content_quantity }}</td>
                            <td>
                                @if ($item->show_homepage==1)
                                <a href="" onclick="homseSectionStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="In-Active" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="homseSectionStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="Active" data-off="In-Active" data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.home-section.edit',$item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
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
            $("#deleteForm").attr("action",'{{ url("admin/home-section/") }}'+"/"+id)
        }

        function homseSectionStatus(id){
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
                url:"{{url('/admin/home-section-status/')}}"+"/"+id,
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
