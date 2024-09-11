<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\leadsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;





Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard',[AdminController::class , 'index'] )->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Resource Routes Starts
        // Leads Route Start
        Route::resource('/lead',leadsController::class);
        Route::resource('/account',AccountController::class);
        Route::resource('/deal',DealController::class);
        // Leads Route End

        // Lead Convert  Route Starts
        Route::get('/lead/convert/{id}',[leadsController::class, 'convert'])->name('lead.convert');
        Route::post('/lead/convert/{id}',[leadsController::class, 'convertPost'])->name('lead.convert.post');
        // Lead Convert  Route End
        
    // Resource Routes End
});

require __DIR__.'/auth.php';
