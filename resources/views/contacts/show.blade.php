@extends('layouts.app')

@section('title')
CRM - Contact Show
@endsection

@section('content')


<div class="d-flex justify-content-between align-items-center">

<h1>Contact Show</h1>
<a href="{{ route('contact.index') }}" class="btn">Back</a>

</div>

<div class="row mt-3">
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
   
                <div class="table-full-width table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>Contact Name</th>
                                <th>Contact Email</th>
                                <th>Contact Phone</th>
                                <th>Account Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $contact->contact_name }}</td>
                                <td>{{ $contact->contact_email }}</td>
                                <td>{{ $contact->contact_phone }}</td>
                                <td>{{ $contact->account->account_name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection