@extends('layouts.app')

@section('title')
CRM - Contact Edit
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center">

    <h1>Contact Edit</h1>
    <a href="{{ route('contact.index') }}" class="btn">Back</a>
    
</div>


<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">

                <form action="{{ route('contact.update',$contact) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="contact_name">Contact Name</label>
                        <input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="Name" value="{{ $contact->contact_name }}">
                        @error('contact_name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="contact_email">Contact Email</label>
                        <input type="text" class="form-control" name="contact_email" id="contact_email" placeholder="Email" value="{{ $contact->contact_email }}">
                        @error('contact_email')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    
                    <div class="form-group">
                        <label for="contact_phone">Contact Phone</label>
                        <input type="text" class="form-control" name="contact_phone" id="contact_phone" placeholder="Phone" value="{{ $contact->contact_phone }}">
                        @error('contact_phone')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="account_id">Account Name</label>
                        <select name="account_id" id="account_id" class="custom-select">
                            <option value="{{ $contact->account_id }}" hidden>{{ $contact->account->account_name }}</option>
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
                            <i class="tim-icons icon-pencil mx-1"></i>
                            Update Contact</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

@endsection