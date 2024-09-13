<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Contact;
use App\Models\Deal;
use Carbon\Carbon;
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
            $query->where('deal_name','LIKE','%'.$search.'%')->orWhere('deal_status','LIKE','%'.$search.'%')
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
        $currentTime = Carbon::now();
        // return $currentTime->format('y-m-d');
      return view('deals.create',compact('accounts','contacts','currentTime'));
    }

   
    public function store(Request $request)
    {
     $validatedRequest =  $request->validate([
            'deal_amount' => 'required|numeric',
            'deal_name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'deal_status' => 'required',
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
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'deal_status' => 'required'
        ]);

        $deal = Deal::find($id);
        if($deal){
            $update = $deal->update([
                'deal_amount' => $request->deal_amount,
                'deal_name' => $request->deal_name,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'deal_status' => $request->deal_status,
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
                'Deal Amount', 'Deal Name', 'Start Date','End Date','Account Name', 'Contact Name', "Deal Status"
            ]);

            foreach($deals as $deal){
                fputcsv($file, [
                    $deal->deal_amount,
                    $deal->deal_name,
                    $deal->start_date,
                    $deal->end_date,
                    $deal->account->account_name,
                    $deal->contact->contact_name,
                    $deal->deal_status
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
