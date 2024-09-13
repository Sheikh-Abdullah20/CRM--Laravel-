<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    public function index(Request $request)
    {
        if($request->filled('account_id')){
            $selectedIds =  $request->account_id;
            $id_into_array = explode(",",$selectedIds);
            $accounts = Account::whereIn('id',$id_into_array)->delete();
            if($accounts){
                Toastr()->error("Selected Accoutns Has Been Deleted Successfully",[],'Deleted');
                return redirect()->back();
            }
        }
        $search = $request->search;
        $accounts = Account::when($search, function($query) use ($search){
            $query->where('account_name','LIKE','%'.$search. '%')
                ->orWhere('account_email','LIKE','%'.$search.'%');
        })->get();
        return view('accounts.index',compact('accounts','search'));
    }

 
    public function create()
    {
       return view('accounts.create');
    }

    public function store(Request $request)
    {
          $request->validate([
            'account_name' => 'required',
            'account_email' => 'required',
            'account_phone' => 'required',
        ]);

        $account = Account::Create([
            'account_name' => $request->account_name,
            'account_email' => $request->account_email,
            'account_website' => $request->account_website,
            'account_phone' => $request->account_phone,
            'creator_id' => Auth::user()->id,
        ]);

       if($account){
        Toastr()->success("Account Has Been created successfully");
         return redirect()->route('account.index');
       } else{
            Toastr()->error("Error Occured While Creating Account");
            return redirect()->back();
       }
        
    }

    public function show(string $id)
    {
        $account = Account::find($id);
        return view('accounts.show',compact('account'));
    }

    public function edit(string $id)
    {
        $account = Account::find($id);
        return view('accounts.edit',compact('account'));
    }

  
    public function update(Request $request, string $id)
    {
        $request->validate([

            'account_name' => 'required',
            'account_phone' => 'required|numeric',
            'account_email' => 'required|email',
        ]);

        $account = Account::find($id);
        if($account){
            $update = $account->update([
                'account_name' => $request->account_name,
                'account_email' => $request->account_email,
                'account_website' => $request->account_website,
                'account_phone' => $request->account_phone,
                'creator_id' => Auth::user()->id
            ]);

            if($update){
                Toastr()->success("Account Has Been Updated Successfully");
                return redirect()->route('account.index');
            }else{
                Toastr()->error("Error Occured While Updating Account");
                return redirect()->back();
            }
        }else{
            Toastr()->error("Account Not Found");
            return redirect()->back();
        }
    }

    public function AccountCsv(){
        $accounts = Account::all();
        $filename = "Account_Report ". time() . ' ' . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

     

        $generate = function() use ($accounts){
            $file = fopen('php://output','w');

            fputcsv($file,[
                'Account Name','Account Email', 'Account Website', 'Account Phone', 'Created Date'
            ]);

            foreach($accounts as $account){
                fputcsv($file,[
                    $account->account_name,
                    $account->account_email,
                    $account->account_website,
                    $account->account_phone,
                    $account->created_at
                ]);
            }
            fclose($file);
        };

        return response()->stream($generate,200,$headers);
    }
    public function destroy(string $id)
    {
        $account = Account::find($id);
        if($account){
            $account->delete();
            Toastr()->error("Account Has Been Deleted Successfully",[],'Deleted');
            return redirect()->back();
        }
    }
}
