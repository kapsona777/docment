@extends('layouts.doctor.layout')
@section('title','Schedule')
@section('doctor-content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Schedule List</h6>
        </div>
        <div class="card-body" id="search-particular-appointment">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Week Day</th>
                            <th>Schedule</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $old_day_id=0;
                        @endphp
                        @foreach ($doctor->schedules as $index => $schedule)
                        @if ($old_day_id != $schedule->day_id)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $schedule->day->day }}</td>
                            <td>
                                @php
                                    $times=$doctor->schedules->where('day_id',$schedule->day_id);
                                @endphp
                                @foreach ($times as $time)
                                {{ strtoupper($time->start_time) }} - {{ strtoupper($time->end_time) }},
                                <br>
                                @endforeach

                            </td>
                        </tr>
                        @endif
                        @php
                            $old_day_id=$schedule->day_id;
                        @endphp


                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
