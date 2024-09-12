<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Contact;
use App\Models\Deal;
use App\Models\Lead;
use Illuminate\Http\Request;

class leadsController extends Controller
{
    
    public function index(Request $request)
    {
        if($request->filled('lead_id')){
            $selectedIds = (string) $request->lead_id;
            $ids_into_array = explode(",",$selectedIds);
            $selected_leads = Lead::whereIn('id',$ids_into_array)->delete();
            Toastr()->error('Selected Leads Has Been deleted successfully',[],"Deleted");
          return redirect()->route('lead.index');
        }

        $search = $request->search;
        $leads = Lead::when($search, function($query) use ($search){
            $query->where('first_name','LIKE','%'.$search.'%')
                    ->where('last_name','LIKE','%'.$search.'%')
                    ->orWhere('email','LIKE','%'. $search . '%');
        })->get();
        return view('leads.index',compact('leads','search'));
    }

    
    public function create()
    {
        return view('leads.create');
    }

    
    public function store(Request $request)
    {
       $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|unique:leads,email',
        'phone' => 'required|numeric',
        'company' => 'required'
       ]);

       $lead = Lead::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'website' => $request->website,
        'phone' => $request->phone,
        'company' => $request->company,
       ]);

       if($lead){
        Toastr()->success('Lead created successfully');
        return redirect()->route('lead.index');
       }else{
        Toastr()->error("Error Occured creating Lead :(");
        return redirect()->route('lead.index');
       }
    }

   
    public function show(string $id)
    {
        $lead = Lead::find($id);
        return view('leads.show',compact('lead'));
    }

    public function edit(string $id)
    {
        $lead = Lead::find($id);
        return view('leads.edit',compact('lead'));
    }

   
    public function update(Request $request, string $id)
    {
        $lead = Lead::find($id);
        if($lead){
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric',
                'company' => 'required'
            ]);

            $update = $lead->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'website' => $request->website,
                'phone' => $request->phone,
                'company' => $request->company,
            ]);

            if($update){
                Toastr()->success('Lead Updated Successfully');
                return redirect()->route('lead.index');
            }else{
                return redirect()->route('lead.index')->with('error','Error Occured While Updating Lead :(');
            }
        }
    }


    public function convert($id){
        $lead = Lead::find($id);
        return view('leads.convert',compact('lead'));
    }


    public function convertPost(Request $request,  $id){
        $request->validate([
            'deal_amount' => 'required|numeric',
            'deal_name' => 'required|string',
            'deal_date' => 'required|date',

        ]);

        $lead = Lead::find($id);
 
        $account = Account::create([
            'account_name' => $lead->company,
            'account_email' => $lead->email,
            'account_website' => $lead->website ?? null,
            'account_phone' => $lead->phone,
        ]);
    
        $contact = Contact::create([
            'contact_name' => $lead->first_name .' '. $lead->last_name,
            'contact_email' => $lead->email,
            'contact_phone' => $lead->phone,
            'account_id' => $account->id,
        ]);


      $deal =   Deal::create([
            'deal_amount' => $request->deal_amount,
            'deal_name' => $request->deal_name,
            'deal_date' => $request->deal_date,
            'account_id' => $account->id,
            'contact_id' => $contact->id,
        ]);

        if($deal){
            Toastr()->success("Deal Has Been Created Succesfully And Account , Contact Has Been Added ");
            $lead->delete();
            return redirect()->route('lead.index');
        }else{
            Toastr()->error("Error Occured While Converting Lead Please Try Again Later");
            return redirect()->back();
        }

    }

    public function leadCsv(){
        $leads = Lead::get();
        $filename = "Lead_report". time() . "." . 'csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' .$filename. '"'
        ];
        $generate = function() use ($leads){
            $file = fopen("php://output",'w');

            fputcsv($file,[
                'First Name', "Last Name" ,"Email" , "Website", "Phone" , "Company"
            ]);

            foreach($leads as $lead){
                fputcsv($file,[
                    $lead->first_name,
                    $lead->last_name,
                    $lead->email,
                    $lead->website ?? 'Website Not Given',
                    $lead->phone,
                    $lead->company,
                ]);
            }
            fclose($file);
        };
        return response()->stream($generate,200,$headers);
    }
   
    public function destroy(string $id)
    {
        $lead  = Lead::find($id);
        if($lead){
            $delete = $lead->delete();

            if($delete){
                Toastr()->error('Lead Has Been Deleted Successfully',[],'Deleted');
                return redirect()->route('lead.index');
            }else{
                Toastr()->error('Error Occured while deleting Lead :(');
                return redirect()->route('lead.index');
            }
        }
    }
}
