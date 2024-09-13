<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
   
    public function index(Request $request)
    {

        if($request->filled('contact_id')){
            $selectedIds =  $request->contact_id;

            $id_into_array = explode(',',$selectedIds);
           $contact =  Contact::whereIn('id' , $id_into_array)->delete();
           
           if($contact){
               Toastr()->error("Selected Contacts Has Been Successfully Deleted",[],"Deleted");
               return redirect()->back();
           }else{
            Toastr()->error("Error Occured While Deleting Selected Contacts");
            return redirect()->back();
           }
        }
        $search = $request->search;
        $contacts = Contact::when($search, function($query) use ($search){
            $query->where('contact_name','LIKE','%'.$search.'%')
                ->orWhere('contact_email','LIKE','%'.$search.'%')
                ->orWhereHas('account',function($qu) use ($search){
                $qu->where('account_name','LIKE','%'.$search.'%');
                });
        })->get();
        return view('contacts.index',compact('contacts','search'));

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
        $valdiatedRequest['creator_id'] = Auth::user()->id;
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
        $accounts = Account::all();
        $contact = Contact::find($id);
        return view('contacts.edit',compact('contact','accounts'));
    }

 
    public function update(Request $request, string $id)
    {
        $validatedRequest = $request->validate([
            'contact_name' => 'required',
            'contact_email' => 'required',
            'contact_phone' => 'required',
            'account_id' => 'required',
        ]);
       $contact = Contact::find($id);

       if($contact){
        $valdiatedRequest['creator_id'] = Auth::user()->id;
        $update =  $contact->update($validatedRequest);

           if($update){
            Toastr()->success('Contact Has Been Updated Successfully');
            return redirect()->route('contact.index');
           }else{
            Toastr()->error('Error Occured While Updating Contact');
            return redirect()->back();
           }
       }
    }


    public function ContactCsv(){
        $contacts = Contact::all();

        $filename = "Contact_Report " . time() . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'. $filename . '"',
        ];


        $generate = function() use ($contacts){
            $file = fopen("php://output",'w');

            fputcsv($file,[
                'Contact Name', 'Contact Email', 'Contact Phone', 'Account Name' , 'Created At'
            ]);

            foreach($contacts as $contact){
                fputcsv($file,[
                    $contact->contact_name, $contact->contact_email, $contact->contact_phone, $contact->account->account_name, $contact->created_at
                ]);
            }
            fclose($file);
        };

        return response()->stream($generate,200,$headers);
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
