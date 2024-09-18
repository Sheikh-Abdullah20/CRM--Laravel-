@extends('layouts.app')

@section('title')
CRM - Show Account
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h1>Account Details</h1>

    <a href="{{ route('account.index') }}" class="btn">Back</a>
</div>


<div class="row my-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="table-full-width table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>Account Name</th>
                                <th>Account Email</th>
                                <th>Account Website</th>
                                <th>Account Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $account->account_name }}</td>
                                <td>{{ $account->account_email }}</td>
                                @if(!empty($account->account_website))
                                <td>
                                   <a href="{{ $account->account_website }}"> {{ $account->account_website }}</a> 
                                </td>
                                @else
                                <td>
                                   Website Not Given
                                 </td>
                                 @endif
                                <td>{{ $account->account_phone }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection