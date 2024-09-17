<?php

namespace App\Console\Commands;

use App\Models\Meeting;
use App\Models\Reminder;
use App\Notifications\MeetingAttendNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class EndMeetingReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:end-meeting-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'End Meeting Reminder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $meetings = Meeting::where('meeting_status','In-Meeting')->get();
        foreach($meetings as $meeting){
            
            $user = $meeting->user;
            $meetingEndTime = $meeting->meeting_to->format("H:i:s");
            $currentTime = Carbon::now();
            $meetingEndInstance = Carbon::now()->createFromFormat("H:i:s",$meetingEndTime, $currentTime->timezone);
            Log::info("Current Time: $currentTime");
            Log::info("Meeting End Time: $meetingEndInstance");
            $diffInMinutes = $currentTime->diffInMinutes($meetingEndTime);
            $threshold = 1;

            Log::info("Diff In Minutes: $diffInMinutes");
            Log::info("Threshold: $threshold");

            if($diffInMinutes <= $threshold){
                $reminder = Reminder::where('meeting_id',$meeting->id)->where('end_meeting_status','false')->where('end_meeting_permission','no-permission')->first();
                if($reminder){
                    $reminder->update([
                        'end_meeting_permission' => 'pending',
                    ]);
                    $message = "Meeting Has Been Finished";
                    Notification::send($user, new MeetingAttendNotification($meeting,$message));
                    Log::info('meeting End:' .$reminder);
                 
                }
                
            }
        }
        
    }
}
