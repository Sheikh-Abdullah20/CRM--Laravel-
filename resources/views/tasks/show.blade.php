@extends('layouts.app')


@section('title')
CRM - Show
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center" >
    <h1>Task Show </h1>

    <a href="{{ route('task.index') }}" class="btn">Back</a>
</div>


<div class="row my-3">
    <div class="col-md-12">

        <div class="card shadow-lg p-3 mb-5 ">
            <div class="card-body p-4 d-flex justify-content-center">
                <div class="table-full-width table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>Priority</th>
                                <th>Due Date</th>
                                <th>Related To</th>
                                <th>Status</th>
                                <th>Task Owner</th>
                            </tr>
                            
                        </thead>

                        <tbody>
                            <tr>
                                <td>{{ $task->priority }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>{{ $task->related_to }}</td>
                                <td>
                                    @if($task->status === 'Not-Started')
                                    <span class="border border-light p-2 rounded">
                                        {{ $task->status }}
                                    </span>

                                    @elseif($task->status === 'In-Progress')
                                    <span class="border border-warning p-2 rounded">
                                        {{ $task->status }}
                                    </span>

                                    @elseif($task->status === 'Completed')
                                    <span class="border border-success p-2 rounded">
                                        {{ $task->status }}
                                    </span>

                                    @elseif($task->status === 'Waiting-For-Input')
                                    <span class="border border-danger p-2 rounded">
                                        {{ $task->status }}
                                    </span>
                                    @endif
                                </td>

                                <td>{{ $task->task_owner }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection