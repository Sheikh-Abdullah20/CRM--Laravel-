<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Contact;
use App\Models\Lead;
use App\Models\Meeting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
  
    public function index(Request $request)
    {
        
       

        if($request->meeting_id){
            $selected_ids =  $request->meeting_id;
            $ids_into_array = explode(',',$selected_ids);
            Meeting::whereIn('id',$ids_into_array)->delete();
            Toastr()->error("Selected Meetings Has Been Deleted",[],'Deleted');
            return redirect()->back();
        }
        $search = $request->search;
        $meetings = Meeting::when($search, function($query) use ($search){
            $query->where('meeting_name' , 'LIKE','%'.$search.'%')
                ->orWhere('meeting_host','LIKE','%'.$search.'%')
                ->orWhere('meeting_status','LIKE','%'.$search.'%');
        })->get();

        // $reminder = explode('-',$meetings->meeting_reminder);
        // return $reminder;
        return view('meetings.index',compact('meetings','search'));
    }

  
    public function create()
    {
        $accounts = Account::all();
        $contacts = Contact::all();
        $leads = Lead::all();

        
        return view('meetings.create',compact('leads','accounts','contacts'));
    }

  
    public function store(Request $request)
    {
       $request->validate([
            'title' => 'required',
            'location' => 'required',
            'from' => 'required|date',
            'to' => 'required|date',
            'host' => 'required',
            'participants' => 'required',
            'related_to' => 'required',
            'meeting_reminder' => 'required',
            'contacts' => 'array',
            'accounts' => 'array',
            'leads' => 'array',
       ]);    

       $contacts = $request->input('contacts',[]);
       $accounts = $request->input('accounts',[]);
       $leads = $request->input('leads',[]);
       
       $participants = array_merge($accounts,$leads,$contacts);
       $participantsString = implode(', ',$participants);
    //    return $participantsString;

       
       $meeting = Meeting::create([
            'meeting_name' => $request->title,
            'meeting_location' => $request->location,
            'meeting_from' => $request->from,
            'meeting_to' => $request->to,
            'meeting_host' => $request->host,
            'meeting_participants' => $request->participants,
            'meeting_participants_id' => $participantsString,
            'meeting_related_to' => $request->related_to,
            'meeting_reminder' => $request->meeting_reminder,
            'meeting_creator_id' => Auth::user()->id
       ]);

       if($meeting){
        Toastr()->success("meeting Has Been Created Succesfully");
        return redirect()->route('meeting.index');
       }
    }

    
    public function show(string $id)
    {
        $meeting = Meeting::find($id);
        return view('meetings.show',compact('meeting'));
    }

   
    public function edit(string $id)
    {
        $meeting = Meeting::find($id);
        $accounts = Account::all();
        $contacts = Contact::all();
        $leads = Lead::all();
        $meetingHasReminder = $meeting->meeting_reminder ?? '';
        $meetingHasparticipantsids= explode(', ', $meeting->meeting_participants_id);
        // return $meetingHasparticipantsids;
        return view('meetings.edit',compact('accounts','leads','contacts','meeting','meetingHasReminder','meetingHasparticipantsids'));
    }

    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'from' => 'required|date',
            'to' => 'required|date',
            'host' => 'required',
            'participants' => 'required',
            'related_to' => 'required',
            'meeting_reminder' => 'required',
            'meeting_status' => 'required',
            'contacts' => 'array',
            'accounts' => 'array',
            'leads' => 'array',
        ]);
       $meeting = Meeting::find($id);
       if($meeting){


       $contacts = $request->input('contacts',[]);
       $accounts = $request->input('accounts',[]);
       $leads = $request->input('leads',[]);
       
       $participants = array_merge($accounts,$leads,$contacts);
       $participantsString = implode(', ',$participants);
    //    return $participantsString;
       $update =  $meeting->update([
            'meeting_name' => $request->title,
            'meeting_location' => $request->location,
            'meeting_from' => $request->from,
            'meeting_to' => $request->to,
            'meeting_host' => $request->host,
            'meeting_participants' => $request->participants,
            'meeting_participants_id' => $participantsString,
            'meeting_related_to' => $request->related_to,
            'meeting_reminder' => $request->meeting_reminder,
            'meeting_creator_id' => Auth::user()->id,
            'meeting_status' => $request->meeting_status,
        ]);

        if($update){
            Toastr()->success("Meeting Has Been Updated Succesfully");
            return redirect()->route('meeting.index');
        }else{
            Toastr()->error("Meeting Has Not Been Updated");
            return redirect()->back();
        }
       }
    }

    
    public function destroy(string $id)
    {
        $meeting = Meeting::find($id);
        if($meeting){
            $meeting->delete();
            Toastr()->error("Meeting Has Been Deleted",[],'Deleted');
            return redirect()->back();
        }
    }
}
