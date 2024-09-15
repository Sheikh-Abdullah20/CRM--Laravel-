@extends('layouts.app')

@section('title')
CRM - Lead Convert
@endsection

@section('content')

<div class="d-flex justify-content-between">
    <h1>Lead Convert </h1>
    <a href="{{ route('lead.show',$lead) }}" class="btn  align-content-center">Back</a>
</div>


<div class="row my-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">

                         <p class="mt-4">
                            Create New Account: 
                            <span class="bg-info p-1 rounded mx-1">
                                {{ $lead->company }}
                            </span>
                         </p>

                         <p class="mt-4">
                            Create New Contact: 
                            <span class="bg-info p-1 rounded mx-1">
                                {{ $lead->first_name .' '.$lead->last_name }}
                            </span>
                         </p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h6>Create New Deal For This Account</h6>
                    </div>
                </div>
                <form action="{{ route('lead.convert.post',$lead) }}" method="POST" class="w-50">
                    @csrf
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control" name="deal_amount" id="amount" 
                        placeholder="Deal Amount">
                        @error('deal_amount')
                            <span class="text-danger">
                                {{ $message }}    
                            </span>                            
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="deal_name">Deal Name</label>
                        <input type="text" class="form-control" name="deal_name" id="deal_name"
                         placeholder="Deal Name">
                        @error('deal_name')
                            <span class="text-danger">
                                {{ $message }}    
                            </span>                            
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" name="start_date" id="start_date" style="cursor: 
                        pointer"  value="{{ old('start_date') }}">
                        @error('start_date')
                            <span class="text-danger">
                                {{ $message }}    
                            </span>                            
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" class="form-control" name="end_date" id="end_date" style="cursor: 
                        pointer" value="{{ old("end_date") }}">
                        @error('end_date')
                            <span class="text-danger">
                                {{ $message }}    
                            </span>                            
                        @enderror
                    </div>

                    <div class="form-group">
                        <button class="btn btn-fill btn-primary" type="submit">Create Deal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection