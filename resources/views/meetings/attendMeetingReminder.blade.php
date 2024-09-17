<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('assets/css/black-dashboard.css?v=1.0.0') }}" rel="stylesheet">
</head>
<body>
    <h1> Meeting Reminder - (  {{ $meeting->meeting_name }} ) </h1>
    <p>This Mail is to Inform You Your Meeting Has Been Started  </p>

    <h2>Meeting Host : <b>{{ $meeting->meeting_host }}</b> </h2>

    <h3>Meeting Participants</h3>
    @php
        $participantsId = explode(',', $meeting->meeting_participants_id);
    @endphp

    @if($meeting->meeting_participants  === 'contacts')
        @php
            $contacts = \App\Models\Contact::whereIn('id',$participantsId)->get();
        @endphp
        @foreach($contacts as $contact)
        <p>{{ $contact->contact_name }}</p>
        @endforeach


        @elseif($meeting->meeting_participants  === 'accounts')
        @php
            $accounts = \App\Models\Account::whereIn('id',$participantsId)->get();
        @endphp
        @foreach($accounts as $account)
        <h3>{{ $account->account_name }}</h3>
        @endforeach



        @elseif($meeting->meeting_participants  === 'leads')
        @php
            $leads = \App\Models\Lead::whereIn('id',$participantsId)->get();
        @endphp
        @foreach($leads as $lead)
        <h3>{{ $lead->first_name . ' ' . $lead->last_name }}</h3>
        @endforeach
    @endif
    <hr>
    <ul>
        <li>Meeting Related to: {{ $meeting->meeting_related_to }}</li>
        <li>Meeting location: {{ $meeting->meeting_location }}</li>
        <li>Meeting starts at: {{ $meeting->meeting_from->format('H:i:s') }}</li>
        <li>Meeting ends at: {{ $meeting->meeting_to->format('H:i:s') }}</li>
    </ul>

    <p class="text-warning"> This Is Not Span Email This is Just Meeting Mail That is Informing You Thanks...</p>
</body>
<script src="{{ asset('assets/js/black-dashboard.js') }}"></script>
</html>