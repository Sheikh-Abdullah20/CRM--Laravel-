@extends('layouts.app')

@section('title')
CRM - Lead Edit
@endsection

@section('content')

<div class="d-flex justify-content-between">
    <h1>Lead - Edit</h1>
    <a href="{{ route('lead.index') }}" class="btn">Back</a>
</div>

<div class="row my-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('lead.update',$lead) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="first_name" id="first_name" value="{{ $lead->first_name }}">
                        @error('first_name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="last_name" id="last_name" value="{{ $lead->last_name }}">
                        @error('last_name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" placeholder="Enter Email" name="email" id="email" value="{{ $lead->email }}">
                        @error('email')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" placeholder="Enter Phone" name="phone" id="phone" value="{{ $lead->phone}}">
                        @error('phone')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="company">Company</label>
                        <input type="text" class="form-control" placeholder="Enter Company" name="company" id="company" value="{{ $lead->company }}">
                        @error('company')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-fill btn-primary">Update Lead</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection