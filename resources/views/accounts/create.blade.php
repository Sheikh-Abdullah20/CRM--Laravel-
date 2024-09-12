@extends('layouts.app')


@section('title')
CRM - Create Account
@endsection


@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Create Account</h1>
    <a href="{{ route('account.index') }}" class="btn">Back</a>
</div>


<div class="row my-3">

    <div class="col-md-12">

        <div class="card">
            <div class="card-body">

                <form action="{{ route('account.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="account_name">Account Name</label>
                            <input type="text" name="account_name" class="form-control" id="account_name">
                            @error('account_name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="account_email">Account Email</label>
                            <input type="text" name="account_email" class="form-control" id="account_email">
                            @error('account_email')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="account_website">Account Website (Not mandatory)</label>
                            <input type="text" name="account_website" class="form-control" id="account_website">
                    </div>

                    <div class="form-group">
                        <label for="account_phone">Account Phone</label>
                            <input type="text" name="account_phone" class="form-control" id="account_phone">
                            @error('account_phone')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                    </div>

                    <div class="form-group">
                       <button class="btn btn-fill btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class=" mx-1 bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                          </svg>
                        Create Account</button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</div>

@endsection