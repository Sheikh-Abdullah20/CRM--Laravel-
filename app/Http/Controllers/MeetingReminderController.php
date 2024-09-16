<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Reminder;
use Illuminate\Http\Request;

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
            Toastr()->success("Meeting Has Been Cancelled :)");
            return redirect()->back();
         } else{
            Toastr()->error("Failed to Update Meeting Status");
            return redirect()->back();
         }

        }
    }
}
