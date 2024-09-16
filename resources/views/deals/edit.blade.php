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
                        <label for="start_date">Start Date</label>
                        <input type="date"  name="start_date" class="form-control" id="start_date" value="{{ $deal->start_date }}">
                        @error('start_date')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" name="end_date" class="form-control" id="end_date" value="{{ $deal->end_date }}" style="cursor: pointer;">
                        @error('end_date')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="deal_status">Deal Status</label>
                        <select name="deal_status" id="deal_status" class="custom-select">
                            <option value="{{ $deal->deal_status }}" hidden>{{ $deal->deal_status }}</option>
                            <option value="Not-Started" >Not-Started</option>
                            <option value="In-Progress" >In-Progress</option>
                            <option value="On-Hold" >On-Hold</option>
                            <option value="Cancelled" >Cancelled</option>
                            <option value="Finished" >Finished</option>
                            
                           </select>
                        @error('deal_status')
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