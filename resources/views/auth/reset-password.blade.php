

@extends('layouts.guest')

@section('title')
CRM - Reset Password
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <div class="d-flex justify-content-between">
            <div class="col-md-12">
                <div class="card w-75 m-auto">
                    <div class="card-header">
                       <div class="flex justify-content-center">
                       <x-application-logo style="width: 50px; fill:white"/>
                       </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('password.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" placeholder="Email" id="email" value="{{ old('email') }}" name="email">
                                @error('email')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        

                        <div class="form-group">
                            <label for="Password">Password</label>
                            <input type="password" class="form-control" placeholder="password" name="password" id="Password" value="{{ old('password') }}">
                            @error('password')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" placeholder="password_confirmation" name="password_confirmation" id="password_confirmation" value="{{ old('password') }}">
                            @error('password_confirmation')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-fill btn-primary">Change Password</button>
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

