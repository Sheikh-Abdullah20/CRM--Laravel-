@extends('layouts.guest')

@section('title')
CRM - Login
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <div class="d-flex justify-content-between">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-center">
                         <x-application-logo style="width: 50px; fill:white"/>
                        </div>
                     </div>
                    <div class="card-body">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ old('first_name') }}" id="first_name">
                                        @error('first_name')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" id="last_name">
                                        @error('last_name')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" placeholder="Email" id="email" value="{{ old('email') }}" name="email">
                                        @error('email')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Password">Password</label>
                                        <input type="password" class="form-control" placeholder="password" name="password" id="Password" value="{{ old('password') }}">
                                        @error('password')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company">Company</label>
                                        <input type="text" class="form-control" placeholder="Company" id="company" value="{{ old('company') }}" name="company">
                                        @error('company')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" placeholder="address" name="address" id="address" value="{{ old('address') }}">
                                        @error('address')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" placeholder="City" id="city" value="{{ old('city') }}" name="city">
                                        @error('city')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" placeholder="Country" name="country" id="country" value="{{ old('country') }}">
                                        @error('country')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                        
                                <div class="form-group">
                                    <button class="btn btn-fill btn-primary">Register</button>
                                </div>
                                
                                <div class="form-group text-center">
                                    <p>Have An Account? </p>
                                    <a href="{{ route('login') }}" class="btn btn-sm">Login</a>
                                </div>
                           
                        </div>
                        </form>
                    </div>
                </div>
            </div>
           </div>
            
        </div>
    </div>
</div>


@endsection