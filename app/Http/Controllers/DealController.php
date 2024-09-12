<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Contact;
use App\Models\Deal;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function index(Request $request)
    {
        if($request->filled('deal_id')){
            $selectedIds = $request->deal_id;
            $id_into_array = explode(",",$selectedIds);
            $deals = Deal::whereIn('id', $id_into_array)->delete();
            if($deals){
                Toastr()->error("Selected Deals Has Been Deleted Succesfully",[],'Deleted');
                return redirect()->back();
            }
        }
        $search = $request->search;
        $deals = Deal::when($search, function($query) use ($search){
            $query->where('deal_name','LIKE','%'.$search.'%')
                ->orWhereHas('account',function($q) use ($search){
                    $q->where('account_name','LIKE','%'.$search.'%');
                })->orWhereHas('contact',function($qu) use ($search){
                    $qu->where('contact_name','LIKE','%'.$search.'%');
                });
           
        })->get();
        return view('deals.index',compact('deals','search'));
    }

 
    public function create()
    {
        $accounts = Account::all();
        $contacts = Contact::all();
      return view('deals.create',compact('accounts','contacts'));
    }

   
    public function store(Request $request)
    {
     $validatedRequest =  $request->validate([
            'deal_amount' => 'required|numeric',
            'deal_name' => 'required',
            'deal_date' => 'required|date',
            'account_id' => 'required',
            'contact_id' => 'required',
        ]);

           $deal =  Deal::create($validatedRequest);

           if($deal){
            Toastr()->success('Deal Has Been created Succesfully');
            return redirect()->route('deal.index');
           }else{
            Toastr()->error('Error Occuered While Creating Deal');
            return redirect()->back();
           }
        

    }

    
    public function show(string $id)
    {
        $deal = Deal::find($id);
       return view('deals.show',compact('deal'));
    }

 
    public function edit(string $id)
    {
       $deal = Deal::find($id);
       return view('deals.edit',compact('deal'));
    }

   
    public function update(Request $request, string $id)
    {
        $request->validate([
            'deal_amount' => 'required|numeric',
            'deal_name' => 'required',
            'deal_date' => 'required|date',
        ]);

        $deal = Deal::find($id);
        if($deal){
            $update = $deal->update([
                'deal_amount' => $request->deal_amount,
                'deal_name' => $request->deal_name,
                'deal_date' => $request->deal_date,
            ]);

            if($update){
                Toastr()->success('Deal Has Been Updated Succesfully');
                return redirect()->route('deal.index');
            }else{
                Toastr()->error('Failed To Update Deal');
                return redirect()->back();
            }
        }
    }

    public function DealCsv(){
        $deals = Deal::all();
        $filename = "Deal_Report " . time() . ' .csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"'
        ];

        $generate = function() use ($deals){
            $file = fopen("php://output",'w');


            fputcsv($file,[
                'Deal Amount', 'Deal Name', 'Deal Date','Account Name', 'Contact Name'
            ]);

            foreach($deals as $deal){
                fputcsv($file, [
                    $deal->deal_amount,
                    $deal->deal_name,
                    $deal->deal_date,
                    $deal->account->account_name,
                    $deal->contact->contact_name
                ]);
            }

            fclose($file);
        };

        return response()->stream($generate,200,$headers);
    }

    public function destroy(string $id)
    {
        $deal = Deal::find($id);

        if($deal){
            $deal->delete();
            Toastr()->error("Deal Has Been Deleted Successfully",[],'Deleted');
            return redirect()->back();
        }
    }
}
