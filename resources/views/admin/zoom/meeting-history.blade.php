@extends('layouts.admin.layout')
@section('title','Zoom Meeting')
@section('admin-content')

    <div class="card shadow mb-4">
        <div class="card-body">
            <h4 class="m-0 font-weight-bold text-primary">Upcoming Meeting</h4>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered" id="example-1" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th >SN</th>
                            <th >Doctor</th>
                            <th >Patient</th>
                            <th >Time</th>
                            <th >Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach ($histories as $index => $meeting)
                        @php
                            $now=date('Y-m-d h:i:A');
                        @endphp

                        @if ($now < date('Y-m-d h:i:A',strtotime($meeting->meeting_time)))
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $meeting->doctor->name }}</td>
                            <td>{{ $meeting->user->name }}</td>
                            <td>
                                {{ date('Y-m-d h:i:A',strtotime($meeting->meeting_time)) }}
                            </td>
                            <td>{{ $meeting->duration }} minute</td>
                        </tr>
                        @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <h4 class="m-0 font-weight-bold text-primary">Previous Meeting</h4>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th >SN</th>
                            <th >Doctor</th>
                            <th >Patient</th>
                            <th >Time</th>
                            <th >Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach ($histories as $index => $meeting)
                        @php
                            $now=date('Y-m-d h:i:A');
                        @endphp

                        @if ($now > date('Y-m-d h:i:A',strtotime($meeting->meeting_time)))
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $meeting->doctor->name }}</td>
                            <td>{{ $meeting->user->name }}</td>
                            <td>
                                {{ date('Y-m-d h:i:A',strtotime($meeting->meeting_time)) }}
                            </td>
                            <td>{{ $meeting->duration }} minute</td>
                        </tr>
                        @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
