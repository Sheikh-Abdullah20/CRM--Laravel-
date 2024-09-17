<?php

namespace App\Console\Commands;

use App\Mail\attendMeetingMail;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Lead;
use App\Models\Meeting;
use App\Models\Reminder;
use App\Models\User;
use App\Notifications\MeetingAttendNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
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
        $user = User::all();
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
                $participants = [];
                $participantsId = explode(', ',$meeting->meeting_participants_id);
                Log::info( 'Participant: ' . $meeting->meeting_participants .' participantsId',$participantsId);
                if($meeting->meeting_participants === 'accounts'){
                    $accounts = Account::whereIn('id',$participantsId)->get();
                    $participants = array_merge($participants, $accounts->pluck('account_email')->toArray()); 
                }elseif($meeting->meeting_participants === 'contacts'){
                    $contacts = Contact::whereIn('id',$participantsId)->get();
                    $participants = array_merge($participants, $contacts->pluck('contact_email')->toArray());
                }elseif($meeting->meeting_participants === 'leads'){
                    $leads = Lead::whereIn('id',$participantsId)->get();
                    $participants = array_merge($participants, $leads->pluck('email')->toArray());
                }

                $participants = array_merge($participants, [$meeting->user->email]);

            
                if(!$reminder){
                    Reminder::create([
                        'message' => 'Your Meeting Time has Came Attend The Meeting ',
                        'meeting_id' => $meeting->id
                    ]);

                    $message = 'Your Meeting Time has Came Attend The Meeting';
                    Notification::send($user, new MeetingAttendNotification($meeting,$message));
                    Mail::to($participants)->send(new attendMeetingMail($meeting));
                    
                }
            }   
        }
    }
}
