<?php

namespace App\Http\Controllers;

use App\Mail\MeetingCancelMail;
use App\Models\Meeting;
use App\Models\Reminder;
use App\Notifications\MeetingAttendNotification;
use App\Notifications\MeetingReminderNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class MeetingReminderController extends Controller
{
    public function accept($id){
        $reminder = Reminder::find($id);
        // return Meeting::where('id',$reminder->meeting_id)->get();
        if($reminder){
           $updatedReminder = $reminder->update([
                'is_attended' => 'true',
            ]);

         $meeting = Meeting::where('id',$reminder->meeting_id)->first();
         $updatedMeeting = $meeting->update([
            'meeting_attended' => 'true',
            'meeting_status' => 'In-Meeting'
         ]); 

         if($updatedMeeting && $updatedReminder){
            Toastr()->success("Meeting Status Has Been Updated Now Attend Meeting :)");
            return redirect()->back();
         }else{
            Toastr()->error("Failed to Update Meeting Status");
            return redirect()->back();
         }

        }
    }



    public function denied($id){
        $reminder = Reminder::find($id);
        if($reminder){
           $updatedReminder = $reminder->delete();

         $meeting = Meeting::where('id',$reminder->meeting_id)->first();
         $updatedMeeting = $meeting->update([
             'meeting_attended' => 'Cancelled',
             'meeting_status' => 'Cancelled'
            ]); 
            
            if($updatedMeeting && $updatedReminder){
                $message = "Your Meeting Has Been Cancelled";
             $mail = Mail::to($meeting->user->email)->send(new MeetingCancelMail($meeting));
             $notification = Notification::send(Auth::user(), new MeetingReminderNotification($meeting,$message));
            Log::info('Meeting Cancellation Mail sent: ' . $meeting->user->email);
            Toastr()->success("Meeting Has Been Cancelled :)");
            return redirect()->back();
         } else{
            Toastr()->error("Failed to Update Meeting Status");
            return redirect()->back();
         }

        }
    }




    public function finished($id){
        $reminder = Reminder::find($id);

        if($reminder){
            $reminder->update([
                'end_meeting_status' => 'true',
                'end_meeting_permission' => 'assigned'
            ]);

            $meeting = Meeting::where('id',$reminder->meeting_id)->first();
            $meeting->update([
                'meeting_status' => 'Finished'
            ]);
            Toastr()->success("Meeting Completed successfully !");
            return redirect()->back();
        }else{
            Toastr()->error("Something Went Wrong While Finishing Meeting :(");
            return redirect()->back();
        }
    }


    public function notyet($id){
        $reminder = Reminder::find($id);

        if($reminder){
            $reminder->update([
                'end_meeting_permission' => 'no-permission',
            ]);

            $meeting = Meeting::where('id',$reminder->meeting_id)->first();
            $meetingto = Carbon::parse($meeting->meeting_to)->addMinutes(10); 
            $meeting->update([
                'meeting_to' => $meetingto
            ]);
            $message = "Meeting Has Been Extended For 10 Minutes";
            Notification::send(Auth::user(), new MeetingAttendNotification($meeting, $message));
            Toastr()->success('Meeting Time 10 Minutes Extended !');
            return redirect()->back();
        }else{
            Toastr()->error('Something Went Wrong While Extending Meeting Time :(');
            return redirect()->back();
        }
    }
}
