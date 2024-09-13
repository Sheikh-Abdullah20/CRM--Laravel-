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
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Account Name</th>
                                <th>Contact Name</th>
                                <th>Deal Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $deal->deal_amount }}</td>
                                <td>{{ $deal->deal_name }}</td>
                                <td>{{ $deal->start_date }}</td>
                                <td>{{ $deal->end_date }}</td>
                                <td>{{ $deal->account->account_name }}</td>
                                <td>{{ $deal->contact->contact_name }}</td>
                                <td>
                                    @if($deal->deal_status === 'Not-Started')
                                    <span class="border border-light p-2 rounded"> Not Started</span>

                                    @elseif($deal->deal_status === 'In-Progress')
                                    <span class="border border-primary p-2 rounded"> In-Progress</span>

                                    @elseif($deal->deal_status === 'On-Hold')
                                    <span class="border border-warning p-2 rounded">  On Hold</span>

                                    @elseif($deal->deal_status === 'Cancelled')
                                    <span class="border border-danger p-2 rounded"> Cancelled</span>

                                    @elseif($deal->deal_status === 'Finished')
                                    <span class="border border-success p-2 rounded"> Finished</span>
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