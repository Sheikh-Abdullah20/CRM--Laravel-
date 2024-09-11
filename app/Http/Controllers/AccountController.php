<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $accounts = Account::all();
        return view('accounts.index',compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $account = Account::find($id);
        return view('accounts.show',compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $account = Account::find($id);
        return view('accounts.edit',compact('account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

            'account_name' => 'required',
            'account_phone' => 'required|numeric',
            'account_website' => 'required',
            'account_email' => 'required|email',
        ]);

        $account = Account::find($id);
        if($account){
            $update = $account->update([
                'account_name' => $request->account_name,
                'account_email' => $request->account_email,
                'account_website' => $request->account_website,
                'account_phone' => $request->account_phone,
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

    /**
     * Remove the specified resource from storage.
     */
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
