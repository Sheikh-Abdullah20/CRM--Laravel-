<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required','email'],
            'password' => ['required'],
            'company' => ['required'],
            'address' => ['required'],
            'country' => ['required'],
            'city' => ['required']
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company' => $request->company,
            'address' => $request->address,
            'country' => $request->country,
            'city' => $request->city
        ]);

        event(new Registered($user));

        Auth::login($user);
        Toastr()->success('Welcome ' . Auth::user()->first_name . ' ' . Auth::user()->last_name);
        return redirect()->route('dashboard');
    }
}
