<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $task->subject }}</title>
    <link href="{{ asset('assets/css/black-dashboard.css?v=1.0.0') }}" rel="stylesheet">
</head>
<body>
    <h1> Task Reminder - (  {{ $task->subject }} ) </h1>
    <p>This Mail is to Inform You Your Task is On Pending ( {{ $task->subject }} )  </p>

    <h2>Task Owner : <b>{{ $task->task_owner }}</b> </h2>

    <hr>
    <ul>
        <li>Task Related to: {{ $task->related_to }}</li>
        <li>Task Priority: {{ $task->priority }}</li>
        <li>Task Status : {{ $task->status }}</li>
        <li>Task starts at: {{ $task->created_at }}</li>
        <li>Task ends at: {{ $task->due_date }}</li>
    </ul>

    <p class="text-warning"> This Is Not Span Email This is Just Meeting Mail That is Informing You Thanks...</p>
</body>
<script src="{{ asset('assets/js/black-dashboard.js') }}"></script>
</html>