@extends('layouts.app')

@section('title')
CRM - Lead Show
@endsection

@section('content')

<div class="d-flex justify-content-between">
    <h1>Lead Show</h1>
    <a href="{{ route('lead.index') }}" class="btn">Back</a>
</div>


<div class="row my-3">

    <div class="col-md-12">

        <div class="card">
            <div class="card-body">

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" value="{{ $lead->first_name }}" class="form-control" id="first_name" readonly>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" value="{{ $lead->last_name }}" class="form-control" id="last_name" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" value="{{ $lead->last_name }}" class="form-control" id="email" readonly>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" value="{{ $lead->phone }}" class="form-control" id="phone" readonly>
                </div>
                <div class="form-group">
                    <label for="Company">Company</label>
                    <input type="text" value="{{ $lead->company }}" class="form-control" id="Company" readonly>
                </div>

                <div class="form-group my-2">
                    <a href="{{ route('lead.convert',$lead) }}" class="btn btn-fill btn-primary">Convert</a>
                </div>
                
                
                
            </div>
        </div>

    </div>

</div>
@endsection