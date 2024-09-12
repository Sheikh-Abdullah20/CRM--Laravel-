<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
   
    public function index()
    {

        $contacts = Contact::all();
        return view('contacts.index',compact('contacts'));

    }


    public function create()
    {
        $accounts = Account::all();
        return view('contacts.create',compact('accounts'));
    }

   
    public function store(Request $request)
    {
      $valdiatedRequest =   $request->validate([
            'contact_name' => 'required',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|numeric',
            'account_id' => 'required',

        ]);

        $contact = Contact::create($valdiatedRequest);

        if($contact){
            Toastr()->success('Contact Has Been Created Successfully');
            return redirect()->route('contact.index');
        }else{
            Toastr()->error('Error Occured While Creating Contact');
            return redirect()->back();
        }
    }

  
    public function show(string $id)
    {
        $contact = Contact::find($id);
        return view('contacts.show',compact('contact'));
    }

 
    public function edit(string $id)
    {
        $contact = Contact::find($id);
        return view('contacts.edit',compact('contact'));
    }

 
    public function update(Request $request, string $id)
    {
        //
    }

   
    public function destroy(string $id)
    {
       $contact = Contact::find($id);

       if($contact){
        $contact->delete();
        Toastr()->error('Contact Has Been Deleted Successfully',[],'Deleted');
        return redirect()->back();
       }else{
        Toastr()->error("Error Occured While Deleting Contact");
        return redirect()->back();
       }
    }
}
