@extends('layouts.app')

@section('title')
CRM - Contacts 
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h1>Contacts</h1>

    <a href="{{ route('contact.create') }}" class="btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class=" mx-2 bi bi-plus-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path>
          </svg>
        Create Contact</a>
</div>


<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between flex-wrap align-items-center">
                    <form action="{{ route('contact.index') }}" method="GET">
                        @csrf
                        <div class="form-group d-flex align-items-center ">
                            <input type="search" name="search" class="form-control" placeholder="Search">
                            <button type="submit" class="btn w-50 p-2 mx-2">Search</button>
                        </div>   
                    </form>
                    
                    @if($contacts->isNotEmpty())
                    <div class="section d-flex">
                    <form id="contactIdFrom" action="{{ route('contact.index') }}" method="GET">
                        @csrf
                        <input type="hidden" name="contact_id" id="contact_id" value="">
                        <span class="btn btn-danger btn-sm  d-flex justify-content-center align-items-center" id="formsubmit"> <i class="tim-icons icon-trash-simple mx-1"></i> 
                            Delete
                        </span>
                    </form>

                    <a href="{{ route('contact.csv') }}" id="export_btn" class="btn btn-sm mx-2 rounded">
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
                                @if($contacts->isNotEmpty())
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
                                <th>Contact Name</th>
                                <th>Contact Email</th>
                                <th>Contact Phone</th>
                                <th>Account Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach($contacts as $contact)
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" name="checkbox" type="checkbox"
                                                value="{{ $contact->id }}">
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    {{ $contact->contact_name }}
                                </td>
                                <td>
                                    {{ $contact->contact_email }}
                                </td>

                                <td>
                                    {{ $contact->contact_phone }}
                                </td>
                                
                                
                                <td>
                                    {{ $contact->account->account_name }}
                                </td>

                                <td class="td-actions">
                                    <div class="d-flex justify-content-around">

                                        <a href="{{ route('contact.show',$contact) }}" class="btn btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">

                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 
                                                3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                            </svg>
                                        </a>

                                        <a href="{{ route('contact.edit',$contact) }}" class="btn btn-sm"> <i
                                                class="tim-icons icon-pencil"></i></a>

                                        <form action="{{ route('contact.destroy',$contact) }}" method="POST">
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
               @if(!empty($search) && $contacts->isEmpty())
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

        let contactInput = document.getElementById('contact_id');
        contactInput.value = selectedIds.join(',');
            contactInput.value = selectedIds;
            console.log(contactInput)
            const confirmed = confirm('Are you sure You Want to Delete?');
            if(confirmed){
                document.getElementById('contactIdFrom').submit()
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
            let contactInput = document.getElementById('contact_id');
            contactInput.value = selectedIds;
            document.getElementById('contactIdFrom').submit();
         
        
        }
    });
    });
    

    document.getElementById('export_btn').addEventListener('click', function(){
        setTimeout(()=>{
            toastr.success("Contact Has Been Exported Succesfully");
        },500)
    });
   
</script>

@endsection