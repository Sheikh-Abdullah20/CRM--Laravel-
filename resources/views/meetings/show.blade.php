@extends('layouts.app')


@section('title')
CRM - Show Meeting
@endsection

@section('content')
<div class="d-flex justify-content-between">
    <h1>Meeting Show</h1>

    <a href="{{ route('meeting.index') }}" class="btn">Back</a>
</div>



<div class="row my-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="table-full-width table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>meeting Title</th>
                                <th>meeting Location</th>
                                <th>meeting From</th>
                                <th>meeting To</th>
                                <th>meeting Participants</th>
                                <th>meeting Host</th>
                                <th>meeting Related</th>
                                <th>meeting Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $meeting->meeting_name }}</td>
                                <td>{{ $meeting->meeting_location }}</td>
                                <td>{{ $meeting->meeting_from }}</td>
                                <td>{{ $meeting->meeting_to }}</td>
                                <td>{{ $meeting->meeting_participants_name }}</td>
                                <td>{{ $meeting->meeting_host }}</td>
                                <td>{{ $meeting->meeting_related_to }}</td>
                                <td>
                                    @if($meeting->meeting_status === 'Waiting')
                                    <span class="border border-light p-1 rounded "style="font-size:10px"> {{ $meeting->meeting_status }}</span>
                                    
                                    @elseif($meeting->meeting_status === 'In-Meeting')
                                    <span class="border border-warning p-1 rounded "style="font-size:10px"> {{ $meeting->meeting_status }}</span>

                                    @elseif($meeting->meeting_status === 'Finished')
                                    <span class="border border-success p-1 rounded "style="font-size:10px"> {{ $meeting->meeting_status }}</span>

                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection