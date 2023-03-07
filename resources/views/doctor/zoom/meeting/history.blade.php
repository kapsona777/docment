@extends('layouts.doctor.layout')
@section('title','Meeting History')
@section('doctor-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('doctor.create-zoom-meeting') }}" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> New Meeting </a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">History Table</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th >SN</th>
                            <th >Patient</th>
                            <th >Time</th>
                            <th >Duration</th>
                            <th >Meeting Id</th>
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
                                <td>{{ $meeting->user->name }}</td>
                                <td>
                                    {{ date('Y-m-d h:i:A',strtotime($meeting->meeting_time)) }}
                                </td>
                                <td>{{ $meeting->duration }} Minute</td>
                                <td>{{ $meeting->meeting_id }}</td>
                                </td>
                            </tr>
                        @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
