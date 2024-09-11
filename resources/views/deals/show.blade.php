@extends('layouts.app')

@section('title')
CRM - Show Deal
@endsection

@section('content')
<div class="d-flex justify-content-between">
    <h1>Deal Details</h1>

    <a href="{{ route('deal.index') }}" class="btn">Back</a>
</div>


<div class="row my-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="table-full-width table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>Deal Amount</th>
                                <th>Deal Name</th>
                                <th>Deal Date</th>
                                <th>Account Name</th>
                                <th>Contact Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $deal->deal_amount }}</td>
                                <td>{{ $deal->deal_name }}</td>
                                <td>{{ $deal->deal_date }}</td>
                                <td>{{ $deal->account->account_name }}</td>
                                <td>{{ $deal->contact->contact_name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection