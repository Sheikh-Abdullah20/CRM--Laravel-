@extends('layouts.app')

@section('title')
CRM - Lead Create
@endsection

@section('content')

<div class="d-flex justify-content-between">    

    <h1>Lead - Create</h1>
    <a href="{{ route('lead.index') }}" class="btn">Back</a>
    
</div>

<div class="row my-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('lead.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="first_name" id="first_name" value="{{ old('first_name') }}">
                        @error('first_name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="last_name" id="last_name" value="{{ old('last_name') }}">
                        @error('last_name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" placeholder="Enter Email" name="email" id="email" value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="Website">Website (Not mandatory)</label>
                        <input type="text" class="form-control" placeholder="Enter Website " name="website" id="Website" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" placeholder="Enter Phone" name="phone" id="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="company">Company</label>
                        <input type="text" class="form-control" placeholder="Enter Company" name="company" id="company" value="{{ old('company') }}">
                        @error('company')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-fill btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class=" mx-1 bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                              </svg>
                            Create Lead</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection