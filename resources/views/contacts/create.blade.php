@extends('layouts.app')

@section('title')
CRM - Create Contact
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center">

    <h1>Create Contact</h1>

    <a href="{{ route('contact.index') }}" class="btn">Back</a>
</div>



<div class="row mt-3">
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="contact_name">Contact Name</label>
                        <input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="Name">
                        @error('contact_name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="contact_email">Contact Email</label>
                        <input type="text" class="form-control" name="contact_email" id="contact_email" placeholder="Email">
                        @error('contact_email')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    
                    <div class="form-group">
                        <label for="contact_phone">Contact Phone</label>
                        <input type="text" class="form-control" name="contact_phone" id="contact_phone" placeholder="Phone">
                        @error('contact_phone')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="account_id">Account Name</label>
                        <select name="account_id" id="account_id" class="form-select">
                            <option value="">Select Account</option>
                            @foreach ($accounts as $account )
                                <option value="{{ $account->id }}">{{ $account->account_name }}</option>
                            @endforeach
                        </select>
                        @error('account_id')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group my-3">
                        <button type="submit" class="btn btn-fill btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class=" mx-1 bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path>
                              </svg>
                            Create Contact</button>
                    </div>
                </form>
                

            </div>
        </div>

    </div>
</div>

@endsection