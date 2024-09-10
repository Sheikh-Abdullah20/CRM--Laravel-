<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\leadsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[AdminController::class , 'index'] )->name('dashboard')->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource Routes
    
        // Leads Route
        Route::resource('/lead',leadsController::class);

    // Resource Routes
});

require __DIR__.'/auth.php';
