<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use Illuminate\Http\Request;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        
        $deals = Deal::all();
        return view('deals.index',compact('deals'));
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
        $deal = Deal::find($id);
       return view('deals.show',compact('deal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $deal = Deal::find($id);
       return view('deals.edit',compact('deal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'deal_amount' => 'required',
            'deal_name' => 'required',
            'deal_date' => 'required',
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

    /**
     * Remove the specified resource from storage.
     */
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
