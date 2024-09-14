<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Contact;
use App\Models\Lead;
use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
  
    public function index(Request $request)
    {
        $meetings = Meeting::all();
        return view('meetings.index',compact('meetings'));
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
            
       ]);

        if($request->has('participants')){
            switch ($request->participants) {
                case 'contacts':
                    $request->validate([
                        'contacts' => 'required'
                    ]);
                    break;
                case 'accounts':
                    $request->validate([
                        'accounts' => 'required'
                    ]);
                    break;
                case 'leads':
                    $request->validate([
                        'leads' => 'required'
                    ]);
                    break;
                default:
                    dd("No Paricipants");
                    break;
               }
        
        }else{
            dd('No Paricipants'); 
        }
       

       
    }

    
    public function show(string $id)
    {
        return view('meetings.show');
    }

   
    public function edit(string $id)
    {
        return view('meetings.edit');
    }

    
    public function update(Request $request, string $id)
    {
        //
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
