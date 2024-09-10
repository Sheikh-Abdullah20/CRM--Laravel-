@extends('layouts.guest')

@section('title')
CRM - Forgot Password
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card w-75 m-auto">
                <div class="card-header">
                    <div class="flex justify-content-center">
                    <a href="{{ route('login') }}"> <x-application-logo style="width: 50px; fill:white"/></a>
                    </div>
                 </div>
                 <div class="card-body">
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                            @error('email')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-fill btn-primary" type="submit">Get Reset Email</button>
                        </div>
                    </form>
                 </div>
            </div>
        </div>
    </div>
</div>

@endsection