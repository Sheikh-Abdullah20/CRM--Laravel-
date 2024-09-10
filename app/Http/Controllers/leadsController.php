<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class leadsController extends Controller
{
    
    public function index()
    {
        $leads = Lead::all();
        return view('leads.index',compact('leads'));
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
        'email' => 'required|email',
        'phone' => 'required|numeric',
        'company' => 'required'
       ]);

       $lead = Lead::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
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
        //
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
                'email' => 'required',
                'phone' => 'required|numeric',
                'company' => 'required'
            ]);

            $update = $lead->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
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
