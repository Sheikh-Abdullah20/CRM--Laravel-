@extends('layouts.app')


@section('title')
CRM - Deal Create
@endsection

@section('content')

<div class="d-flex justify-content-between">

    <h1>Deal Create</h1>
    <a href="{{ route('deal.index') }}" class="btn">Back</a>

</div>


<div class="row mt-3">
    <div class="col-md-12">
     
        <div class="card">
            <div class="card-body">
                <form action="{{ route('deal.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="deal_amount">Deal Amount</label>
                        <input type="text" name="deal_amount" class="form-control" id="deal_amount" value="{{ old('deal_amount') }}" placeholder="Amount">
                        @error('deal_amount')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
        
                    <div class="form-group">
                        <label for="deal_name">Deal Name</label>
                        <input type="text" name="deal_name" class="form-control" id="deal_name" value="{{ old('deal_name') }}" placeholder="Name">
                        @error('deal_name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
        
        
                    <div class="form-group">
                        <label for="deal_date">Deal Date</label>
                        <input type="date" name="deal_date" class="form-control" id="deal_date" value="{{ old('deal_date') }}">
                        @error('deal_date')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="account_id">Account Name</label>
                        <select name="account_id" id="account_id" class="form-select">
                            <option value="" hidden>Select Contact</option>
                            @foreach($accounts as $account )
                                <option value="{{ $account->id }}">{{ $account->account_name }}</option>
                            @endforeach
                           </select>
                        @error('account_id')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="contact_id">Contact Name</label>
                       <select name="contact_id" id="contact_id" class="form-select">
                        <option value="" hidden>Select Contact</option>
                        @foreach($contacts as $contact )
                            <option value="{{ $contact->id }}">{{ $contact->contact_name }}</option>
                        @endforeach

                       </select>
                        @error('contact_id')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group my-3">
                       <button type="submit" class="btn btn-fill btn-primary">  
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class=" mx-2 bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path>
                          </svg>
                        Create Deal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection