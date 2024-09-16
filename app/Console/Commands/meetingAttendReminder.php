<?php

namespace App\Console\Commands;

use App\Models\Meeting;
use App\Models\Reminder;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class meetingAttendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:meeting-attend-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Meeting Attend Reminder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $meetings = Meeting::where('meeting_reminder_status','true')->where('meeting_attended','false')->get();
        foreach($meetings as $meeting){

            $Reminder = $meeting->meeting_from;
            $onlyTime = $Reminder->format('H:i:s');
            $currentTime = Carbon::now();
            
            $meetingTimeInstance = Carbon::createFromFormat("H:i:s",$onlyTime, $currentTime->timezone);

            $threshold = 1; //1 minute
            $differenceInTime = $currentTime->diffInMinutes($meetingTimeInstance);


           Log::info("Current Time: $currentTime");
           Log::info("Meeting Time: $meetingTimeInstance");
           Log::info("Difference In Minutes: $differenceInTime");
          
            if($differenceInTime  <= $threshold){
                Log::info("Attend Meeting Asap: ". $currentTime . ' ' . $onlyTime);
                
                $reminder = Reminder::where('is_attended',false)->where('meeting_id',$meeting->id)->first();
            
                if(!$reminder){
                    Reminder::create([
                        'message' => 'Your Meeting Time has Came Be Ready For Meeting ',
                        'meeting_id' => $meeting->id
                    ]);
                }
            }   
        }
    }
}
