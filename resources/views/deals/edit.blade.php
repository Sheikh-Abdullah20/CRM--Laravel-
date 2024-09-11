@extends('layouts.app')

@section('title')
CRM - Deal Edit
@endsection

@section('content')
<div class="d-flex justify-content-between">
    <h1>Deal Edit</h1>

    <a href="{{ route('deal.index') }}" class="btn align-content-center">Back</a>
</div>


<div class="row my-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('deal.update',$deal) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="deal_amount">Deal Amount</label>
                        <input type="text" name="deal_amount" class="form-control" id="deal_amount" value="{{ $deal->deal_amount }}">
                        @error('deal_amount')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="deal_name">Deal Name</label>
                        <input type="text" name="deal_name" class="form-control" id="deal_name" value="{{ $deal->deal_name }}">
                        @error('deal_name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="deal_date">Deal Date</label>
                        <input type="text" name="deal_date" class="form-control" id="deal_date" value="{{ $deal->deal_date }}">
                        @error('deal_date')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                       <button type="submit" class="btn btn-fill btn-primary">  <i
                        class="tim-icons icon-pencil mx-1"></i>  Update Deal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection