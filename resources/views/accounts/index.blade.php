@extends('layouts.app')

@section('title')
CRM - Accounts
@endsection

@section('content')
{{--
<x-alert /> --}}
<div class="d-flex justify-content-between align-items-center">
    <h1>Accounts</h1>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between flex-wrap align-items-center">
                    <form action="{{ route('account.index') }}" method="GET">
                        @csrf
                        <div class="form-group d-flex align-items-center ">
                            <input type="search" name="search" class="form-control" placeholder="Search">
                            <button type="submit" class="btn w-50 p-2 mx-2">Search</button>
                        </div>   
                    </form>
                    
                    @if($accounts->isNotEmpty())
                    <div class="section d-flex">
                    <form id="accountIdForm" action="{{ route('account.index') }}" method="GET">
                        @csrf
                        <input type="hidden" name="account_id" id="account_id" value="">
                        <span class="btn btn-danger btn-sm  d-flex justify-content-center align-items-center" id="formsubmit"> <i class="tim-icons icon-trash-simple mx-1"></i> 
                            Delete
                        </span>
                    </form>

                    <a href="{{ route('account.csv') }}" id="export_btn" class="btn btn-sm mx-2 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download mx-1" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                          </svg>
                        Export CSV</a>
                </div>
                    @endif
                </div>
            </div>
           
         

            <div class="card-body">
                <div class="table-full-width table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                @if($accounts->isNotEmpty())
                                <th>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" id="selectAll" type="checkbox" value="">
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </th>
                                @endif
                                <th>Account Name</th>
                                <th>Account Email</th>
                                <th>Account Website</th>
                                <th>Account Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach($accounts as $account)
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" name="checkbox" type="checkbox"
                                                value="{{ $account->id }}">
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    {{ $account->account_name }}
                                </td>
                                <td>
                                    {{ $account->account_email }}
                                </td>
                                @if(!empty($account->account_website))
                                <td>
                                    <a href="  {{ $account->account_website }}"> {{ $account->account_website }}</a>
                                </td>
                                @else
                                <td>Website Not Given
                                    @endif
                                </td>
                                <td>
                                    {{ $account->account_phone }}
                                </td>

                                <td class="td-actions">
                                    <div class="d-flex justify-content-around">

                                        <a href="{{ route('account.show',$account) }}" class="btn btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">

                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 
                                                3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                            </svg>
                                        </a>

                                        <a href="{{ route('account.edit',$account) }}" class="btn btn-sm"> <i
                                                class="tim-icons icon-pencil"></i></a>

                                        <form action="{{ route('account.destroy',$account) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit"
                                        onclick="if (!confirm('Are you sure you want to delete?')) { toastr.success('Deletion Has Been Cancelled'); return false; }"
                                        class="btn btn-sm btn-danger"> <i
                                            class="tim-icons icon-trash-simple"></i></button>
                                        </form>
                                    </div>


                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
               @if(!empty($search) && $accounts->isEmpty())
                @php
                    Toastr()->error("No Search Result Found - Please try Another Search",[],"No Result Found ");
                @endphp
               @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function(){
        document.getElementById('formsubmit').addEventListener('click',function(){
        let checkboxes = document.querySelectorAll('input[name= checkbox]:checked');
        
        if(checkboxes.length < 1){
            toastr.error("Please Select Any account First");
            return false;
        }else{
            let selectedIds = [];
        checkboxes.forEach(function(checkbox) {
            selectedIds.push(checkbox.value);
        });

        let accountInput = document.getElementById('account_id');
        accountInput.value = selectedIds.join(',');
            accountInput.value = selectedIds;
            console.log(accountInput)
            const confirmed = confirm('Are you sure You Want to Delete?');
            if(confirmed){
                document.getElementById('accountIdForm').submit()
            }else{
                toastr.success("account Deletion Cancelled");
                return false;
            }

        }
    });
   
    const selectAllCheckbox = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('input[name="checkbox"]');

    selectAllCheckbox.addEventListener('change',function(){
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = selectAllCheckbox.checked;
        });
       
        if(selectAllCheckbox){
            let selectedIds = [];
            checkboxes.forEach(checkbox =>{
                checkbox.value = selectedIds.joins(",")
            });
            let accountInput = document.getElementById('account_id');
            accountInput.value = selectedIds;
            document.getElementById('accountIdFrom').submit();
         
        
        }
    });
    });
    

    document.getElementById('export_btn').addEventListener('click', function(){
        setTimeout(()=>{
            toastr.success("Accounts Has Been Exported Succesfully");
        },500)
    });
   
</script>

@endsection