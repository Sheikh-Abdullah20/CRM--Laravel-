@extends('layouts.app')


@section('title')
CRM - Edit Task
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Edit Task</h1>

    <a href="{{ route('task.index') }}" class="btn">Back</a>
</div>


<div class="row my-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('task.update',$task) }}" method="POST" class="p-2">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="task_owner">Task Owner</label>
                        <input type="text" class="form-control" name="task_owner" id="task_owner" placeholder="Task Owner" value="{{ $task->task_owner }}">
                        @error('task_owner')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" value="{{ $task->subject }}">
                        @error('subject')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <input type="datetime-local" class="form-control" name="due_date" id="due_date" value="{{ $task->due_date }}">
                        @error('due_date')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="group">Group</label>
                        <select  class="form-control" name="group" id="group">
                            <option value="" hidden>Select Group</option>
                            <option value="Leads" {{  $task->group  === 'Leads' ? 'selected' : '' }} >Leads</option>
                            <option value="Accounts" {{  $task->group  === 'Accounts' ? 'selected' : '' }} >Accounts</option>
                            <option value="Contacts" {{  $task->group  === 'Contacts' ? 'selected' : '' }} >Contacts</option>
                        </select>
                        @error('group')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group my-3" style="display:none" id="leads">
                        <select class="form-control" id="person_of_leads">
                            <option value="" hidden>Select Lead</option>
                            @foreach($leads as $lead)
                            <option value="{{ $lead->first_name . ' ' . $lead->last_name }}" {{ $task->person_of_group === $lead->first_name . ' ' . $lead->last_name ? 'selected' : '' }}>{{ $lead->first_name . ' ' . $lead->last_name }} 
                            </option>
                            @endforeach
                        </select>
                        @error('person_of_group')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    <div class="form-group my-3" style="display:none" id="contacts">
                        <select class="form-control" id="person_of_contacts">
                            <option value="" hidden>Select Contact</option>
                            @foreach($contacts as $contact)
                                <option value="{{ $contact->contact_name }}" {{ $task->person_of_group === $contact->contact_name ? 'selected' : '' }} >{{ $contact->contact_name }}</option>
                            @endforeach
                        </select>
                        @error('person_of_group')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>



                    <div class="form-group my-3" style="display:none" id="accounts">
                        <select class="form-control"  id="person_of_accounts">
                            <option value="" hidden>Select Account</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->account_name }}" {{ $task->person_of_group === $account->account_name ? 'selected' : '' }}>{{ $account->account_name }}</option>
                            @endforeach
                        </select>   
                        @error('person_of_group')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    <div class="form-group my-3">
                        <label for="related_to">Related To</label>
                        <input class="form-control" name="related_to" id="related_to" placeholder="Related To" value="{{ $task->related_to }}">  
                        @error('related_to')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    
                    <div class="form-group my-3">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="" hidden>Select Status</option>
                            <option value="Not-Started" {{ $task->status ===  'Not-Started' ? 'selected' : ''  }} >Not-Started</option>
                            <option value="In-Progress" {{ $task->status ===  'In-Progress' ? 'selected' : ''  }} >In-Progress</option>
                            <option value="Completed" {{ $task->status ===  'Completed' ? 'selected' : ''  }} >Completed</option>
                            <option value="Waiting-For-Input" {{ $task->status ===  'Waiting-For-Input' ? 'selected' : ''  }} >Waiting-For-Input</option>
                        </select>   
                        @error('status')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>



                    <div class="form-group my-3">
                        <label for="priority">Priority</label>
                        <select class="form-control" name="priority" id="priority">
                            <option value="" hidden>Select Priority</option>
                            <option value="High" {{ $task->priority === 'High' ? 'selected' : '' }} >High</option>
                            <option value="Highest" {{ $task->priority === 'Highest' ? 'selected' : '' }} >Highest</option>
                            <option value="Low" {{ $task->priority === 'Low' ? 'selected' : '' }} >Low</option>
                            <option value="Lowest" {{ $task->priority === 'Lowest' ? 'selected' : '' }} >Lowest</option>
                            <option value="Normal" {{ $task->priority === 'Normal' ? 'selected' : '' }} >Normal</option>
                        </select>   
                        @error('status')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    <div class="form-check mt-4 d-flex ">
                        <label for="reminder">Reminder</label>
                        <label class="form-check-label mx-3">
                            <input class="form-check-input" type="checkbox" name="reminder" id="reminder" {{ $task->reminder === 'true' ? 'checked' : '' }}>
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label> 
                        @error('reminder')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group my-4" style="display: none" id="reminder_timee">
                        <label for="reminder_time">Reminder Time</label>
                        <input type="datetime-local" class="form-control" name="reminder_time" id="reminder_time" value="{{ $task->reminder_time }}"  >

                        @error('reminder_time')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                

                    <div class="form-group my-4 ">
                        <label for="descripiton">Decription Information</label>
                        <textarea class="form-control" name="description" id="descripiton">{{ $task->description }}</textarea>
                    </div>



                    <div class="form-group">
                        <button class="btn btn-fill btn-primary" type="submit">
                            <i class="tim-icons icon-pencil mx-1"></i>
                            Update Task</button>
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

    const selected = document.getElementById('group');
    const leads = document.getElementById('leads');
    const accounts = document.getElementById('accounts');
    const contacts = document.getElementById('contacts');

        function updateVisibility (){
            if(selected.value === 'Leads'){
            leads.style.display = 'block';
            contacts.style.display = 'none';
            accounts.style.display = 'none';
            document.getElementById('person_of_leads').setAttribute('name','person_of_group');
        }else if(selected.value === 'Accounts'){
            accounts.style.display = 'block';
            leads.style.display = 'none';
            contacts.style.display = 'none';
            document.getElementById('person_of_accounts').setAttribute('name','person_of_group');
        }else if(selected.value === 'Contacts'){
            contacts.style.display = 'block';
            leads.style.display = 'none';
            accounts.style.display = 'none';
            document.getElementById('person_of_contacts').setAttribute('name','person_of_group');
        }else{
            contacts.style.display = 'none';
            accounts.style.display = 'none';
            leads.style.display = 'none';
        }
        }
       
        updateVisibility();

       selected.addEventListener('change', updateVisibility); 
   

       const reminder = document.querySelector('input[name="reminder"]');
        const reminder_time =   document.getElementById('reminder_timee');

       function updateCheckbox(){
        if(reminder.checked){
            console.log('Reminder changed')
            console.log(reminder_time)
            reminder_time.style.display = 'block'
          
        }else{
            reminder_time.style.display = 'none'
        }
       }
       
     updateCheckbox()


        reminder.addEventListener('change', updateCheckbox)

});

</script>

@endsection