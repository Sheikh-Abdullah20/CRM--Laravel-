@extends('layouts.app')


@section('title')
CRM - Create Meeting
@endsection

@section('content')
<div class="d-flex justify-content-between">
    <h1>Create Meeting</h1>

    <a href="{{ route('meeting.index') }}" class="btn">Back</a>
</div>


<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">

                <form action="{{ route('meeting.store') }}" method="POST" class="p-3">
                    @csrf
                    
                    <div class="form-group mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ old('title') }}">
                        @error('title')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="location" value="{{ old('location') }}">
                        @error('location')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    <div class="form-group mb-3">
                        <label for="from">From</label>
                        <input type="datetime-local" class="form-control" id="from" name="from" value="{{ old('from') }}">
                        @error('from')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    <div class="form-group mb-3">
                        <label for="to">To</label>
                        <input type="datetime-local" class="form-control" id="to" name="to" value="{{ old('to') }}">
                        @error('to')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    <div class="form-group mb-3">
                        <label for="host">Host</label>
                        <input type="text" class="form-control" id="host" name="host" placeholder="Host" value="{{ old('host') }}">
                        @error('host')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3" >
                        <label for="participants">Participants</label>
                        <select class="form-select" id="participants" name="participants">
                            <option value="" hidden>Select Participant</option>
                            <option value="contacts" {{ old('participants')=== 'contacts' ? 'selected' : ''  }} >Contacts</option>
                            <option value="accounts" {{ old('participants')=== 'accounts' ? 'selected' : ''  }} >Accounts</option>
                            <option value="leads" {{ old('participants')=== 'leads' ? 'selected' : ''  }} >Leads</option>  
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


                    <div class="form-group mb-5 " id="contact" style="display: none;">
                        <label for="contacts">Contacts</label>
                        <select class="form-select" id="contacts" name="contacts">
                            <option value="" hidden>Select Participant</option>
                           @foreach($contacts as $contact)
                            <option value="{{ $contact->id}}">{{ $contact->contact_name }}</option>
                           @endforeach
                        </select>
                        
                    </div>


                    <div class="form-group mb-5 " id="account" style="display: none;">
                        <label for="accounts">Accounts</label>
                        <select class="form-select" id="accounts" name="accounts">
                            <option value="" hidden >Select Participant</option>
                           @foreach($accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->account_name }}</option>
                           @endforeach
                        </select>
                        
                    </div>


                    <div class="form-group mb-5 " id="lead" style="display: none;">
                        <label for="leads">Leads</label>
                        <select class="form-select" id="leads" name="leads">
                            <option value="" hidden>Select Participant</option>
                           @foreach($leads as $lead)
                            <option value="{{ $lead->id }}">{{ $lead->first_name . ' ' . $lead->last_name }}</option>
                           @endforeach
                        </select>
                        
                    </div>

                    <div class="form-group">
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