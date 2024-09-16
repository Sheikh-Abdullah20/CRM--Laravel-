<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\leadsController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\MeetingReminderController;
use App\Http\Controllers\notificationControlController;
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
        Route::resource('/contact',ContactController::class);
        Route::resource('/deal',DealController::class);
        Route::resource('/meeting',MeetingController::class);
        // Leads Route End



        // Lead Convert  Route Starts
        Route::get('/lead/convert/{id}',[leadsController::class, 'convert'])->name('lead.convert');
        Route::post('/lead/convert/{id}',[leadsController::class, 'convertPost'])->name('lead.convert.post');
        // Lead Convert  Route End

        // Notification Control Controller Route Start
        Route::get('/contact/notification/mark-as-read/{id}',[notificationControlController::class, 'markAsRead'])->name('notificationMarkAsRead');
        Route::get('/contact/notification/delete/{id}',[notificationControlController::class, 'deleteNotification'])->name('deleteNotification');
        // Notification Control Controller Route End


        // Meeting Reminder Routes Start
        Route::get('meeting/reminder/accept/{id}',[MeetingReminderController::class,'accept'])->name('reminder_accept');
        Route::get('meeting/reminder/denied/{id}',[MeetingReminderController::class,'denied'])->name('reminder_denied');
        // Meeting Reminder Routes End

        // DownloadReport Csv Route Start
        Route::get('/download/lead/csv',[leadsController::class, 'leadCsv'])->name('lead.csv');
        Route::get('/download/account/csv',[AccountController::class, 'AccountCsv'])->name('account.csv');
        Route::get('/download/deal/csv',[DealController::class, 'DealCsv'])->name('deal.csv');
        Route::get('/download/contact/csv',[ContactController::class, 'ContactCsv'])->name('contact.csv');
        // DownloadReport Csv Route Start ends
        
    // Resource Routes End
});

require __DIR__.'/auth.php';
