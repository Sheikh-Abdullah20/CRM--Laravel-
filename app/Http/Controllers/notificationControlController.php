<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class notificationControlController extends Controller
{
    
    public function markAsRead($id){
        $notification = Auth::user()->notifications->where('id',$id)->markAsRead();
        Toastr()->success('Notification Marked As Read');
        return redirect()->back();
    }

    public function deleteNotification($id){
        $notification = Auth::user()->notifications->find($id);
        if($notification){
            $notification->delete();
            Toastr()->success('Notification Has Been Deleted');
            return redirect()->back();
        }
    }
}
