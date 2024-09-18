@extends('layouts.app')


@section('title')
CRM - Create Meeting
@endsection
@section('css')

<style>
 option {
    color: rgb(187, 146, 146)
 }
</style>
@endsection
@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h1>Create Meeting</h1>

    <a href="{{ route('meeting.index') }}" class="btn">Back</a>
</div>


<div class="row my-3">
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">

                <form action="{{ route('meeting.store') }}" method="POST" >
                    @csrf
                    
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ old('title') }}">
                        @error('title')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="location" value="{{ old('location') }}">
                        @error('location')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    <div class="form-group ">
                        <label for="from">From</label>
                        <input type="datetime-local" class="form-control" id="from" name="from" value="{{ old('from') }}">
                        @error('from')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    <div class="form-group ">
                        <label for="to">To</label>
                        <input type="datetime-local" class="form-control" id="to" name="to" value="{{ old('to') }}">
                        @error('to')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="host">Host</label>
                        <input type="text" class="form-control" id="host" name="host" placeholder="Host" value="{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}">
                        @error('host')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" >
                        <label for="participants">Participants</label>
                        <select class="custom-select" id="participants" name="participants">
                            <option value="" hidden>None</option>
                            <option class="option" value="contacts" {{ old('participants')=== 'contacts' ? 'selected' : ''  }} >Contacts</option>
                            <option class="option" value="accounts" {{ old('participants')=== 'accounts' ? 'selected' : ''  }} >Accounts</option>
                            <option class="option" value="leads" {{ old('participants')=== 'leads' ? 'selected' : ''  }} >Leads</option>  
                        </select>
                        @if ($errors->has('participants'))
                        <span class="text-danger">
                            {{ $errors->first('participants') }}
                        </span>

                        @elseif($errors->has('contacts'))
                        <span class="text-danger">
                            {{ $errors->first('contacts') }}
                        </span>

                        @elseif($errors->has('accounts'))
                        <span class="text-danger">
                            {{ $errors->first('accounts') }}
                        </span>

                        @elseif($errors->has('leads'))
                        <span class="text-danger">
                            {{ $errors->first('leads') }}
                        </span>
                        @endif
                        
                    </div>

                    <div class="form-group  " id="contact" style="display: none;">
                        <label for="contacts">Contacts</label>
                        <select class="custom-select" id="contacts" name="contacts[]" multiple size="10">
                            <option value="" hidden>Select Contacts</option>
                           @foreach($contacts as $contact)
                            <option class="option" value="{{ $contact->id}}">{{ $contact->contact_name }}</option>
                           @endforeach
                        </select>
                        
                    </div>


                    <div class="form-group " id="account" style="display: none;">
                        <label for="accounts">Accounts</label>
                        <select class="custom-select" id="accounts" name="accounts[]" multiple size="10">
                            <option value="" hidden >Select Accounts</option>
                           @foreach($accounts as $account)
                            <option class="option" value="{{ $account->id }}">{{ $account->account_name }}</option>
                           @endforeach
                        </select>
                        
                    </div>


                    <div class="form-group " id="lead" style="display: none;">
                        <label for="leads">Leads</label>
                        <select class="custom-select" id="leads" name="leads[]" multiple size="10">
                            <option value="" hidden>Select Leads</option>
                           @foreach($leads as $lead)
                            <option class="option" value="{{ $lead->id }}" >{{ $lead->first_name . ' ' . $lead->last_name }}</option>
                           @endforeach
                        </select>
                        
                    </div>

                    <div class="form-group " id="related_to">
                        <label for="related_to_select">Related To</label>
                        <input type="text" name="related_to" id="related_to" class="form-control" placeholder="Add Realted About Meeting">
                        @error('related_to')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            
                        @enderror
                        
                    </div>

                    



                    <div class="form-group  " id="meeting_reminder">
                        <label for="meeting_reminder">Meeting Reminder</label>
                        <select class="custom-select" id="related_to_value_leads" name="meeting_reminder">
                            <option value="" hidden>None</option>
                            <option class="option" value="30-Minutes" >30-Minutes</option>
                            <option class="option" value="1-Hour" >1-Hour</option>
                            <option class="option" value="5-Hour" >5-Hour</option>
                            <option class="option" value="1-Day" >1-Day</option>
                        
                        </select>
                        @error('meeting_reminder')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            
                        @enderror     
                    </div>


                    <div class="form-group my-4">
                        <button type="submit" class="btn btn-fill btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class=" mx-2 bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path>
                              </svg>
                            Create Meeting</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')

<script>

document.addEventListener('DOMContentLoaded',function(){

    const participant = document.getElementById('participants');
    const contact = document.getElementById('contact');
    const account = document.getElementById('account');
    const lead = document.getElementById('lead');

        function updateSelect(){
            if(participant.value === 'contacts'){
            contact.style.display = 'block';
            account.style.display = 'none';
            lead.style.display = 'none';
        }else if(participant.value === 'accounts'){
            contact.style.display = 'none';
            account.style.display = 'block';
            lead.style.display = 'none';
        }else if(participant.value === 'leads'){
            contact.style.display = 'none';
            account.style.display = 'none';
            lead.style.display = 'block';
        }else{
            contact.style.display = 'none';
            account.style.display = 'none';
            lead.style.display = 'none';
        }
        }
       
  updateSelect();
  participant.addEventListener('change', updateSelect);
});


</script>

@endsection