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
                <div class="card w-75 m-auto">
                    <div class="card-header">
                       <div class="flex justify-content-center">
                       <x-application-logo style="width: 50px; fill:white"/>
                       </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
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
                    <div class="d-flex justify-content-between align-items-center">
                        
                            <div class="form-group">
                                <button type="submit" class="btn btn-fill btn-primary">Login</button>
                               <a href="{{ route('password.request') }}"> <p class="text-primary my-3">Forgot Password?</p></a>
                            </div>
                            
                            <div class="form-group text-center">
                                <p>Dont Have An Account? </p>
                                <a href="{{ route('register') }}" class="btn btn-sm">Register</a>
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