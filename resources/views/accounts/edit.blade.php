@extends('layouts.app')

@section('title')
CRM - Account Edit
@endsection

@section('content')
<div class="d-flex justify-content-between">
    <h1>Edit Account</h1>

    <a href="{{ route('account.index') }}" class="btn align-content-center">Back</a>
</div>


<div class="row my-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('account.update',$account) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="account_name">Account Name</label>
                        <input type="text" name="account_name" id="account_name" class="form-control" value="{{ $account->account_name }}">
                        @error('account_name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="account_email">Account Email</label>
                        <input type="text" name="account_email" id="account_email" class="form-control" value="{{ $account->account_email }}">
                        @error('account_email')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="account_website">Account Website</label>
                        <input type="text" name="account_website" id="account_website" class="form-control" value="{{ $account->account_website }}">
                        @error('account_website')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="account_phone">Account Phone</label>
                        <input type="text" name="account_phone" id="account_phone" class="form-control" value="{{ $account->account_phone }}">
                        @error('account_phone')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-fill btn-primary"> <i
                        class="tim-icons icon-pencil mx-1"></i>  Update Account</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection