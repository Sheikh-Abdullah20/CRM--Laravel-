<?php

namespace App\Http\Controllers;

use App\Mail\guestQueriesMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class guestController extends Controller
{
    public function index(){
        return view('welcome');
    }


    public function queries(Request $request){
        $user = User::where('email','abdullahsheikhmuhammad21@gmail.com')->first();

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'description' => 'required'
        ]);

        if($validator->fails()){
            Toastr()->error("Please Fill All The Form Fields",[],'Validation Error');
            return redirect()->back();
        }

        $mail = Mail::to($user->email)->send(new guestQueriesMail($request->all()));

        if($mail){
            Toastr()->success("Your Query Has Been Sent Successfully");
            return redirect()->back();
        }
    }
}
