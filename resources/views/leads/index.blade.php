@extends('layouts.app')

@section('title')
CRM - Leads
@endsection

@section('content')
{{-- <x-alert/> --}}
<div class="d-flex justify-content-between align-items-center">
    <h1>Leads</h1>
    <a href="{{ route('lead.create') }}" class="btn d-flex">Create Lead</a>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-full-width table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="">
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Company</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach($leads as $lead)
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="{{ $lead->id }}">
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    {{ $lead->name }}
                                </td>
                                <td>
                                    {{ $lead->email }}
                                </td>
                                <td>
                                    {{ $lead->phone }}
                                </td>
                                <td>
                                    {{ $lead->company }}
                                </td>

                                <td class="td-actions">
                                    <div class="d-flex justify-content-around">
                                        <a href="{{ route('lead.edit',$lead) }}" class="btn btn-sm"> <i class="tim-icons icon-pencil"></i></a>

                                        <form action="{{ route('lead.destroy',$lead) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" onclick="return confirm('are You sure You want to delete?')" class="btn btn-sm btn-danger"> <i class="tim-icons icon-trash-simple"></i></button>
                                        </form>
                                    </div>
                                  
                                    
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection