<?php

namespace App\Console\Commands;

use App\Mail\MeetingReminderMail;
use App\Models\Meeting;
use App\Models\User;
use App\Notifications\MeetingReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class sendMeetingReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-meeting-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is Meeting Reminder ';

    /**
     * Execute the console command.
     */
    public function handle()
    {   
        $user = User::all();
        $meetings = Meeting::where('meeting_reminder_status','false')->get();
        $reminderSent = 'false';
        foreach($meetings as $meeting){
            $reminderTime = $this->parseReminderTime($meeting->meeting_reminder);
            Log::info('ReminderTime: ' . $reminderTime);
            Log::info("Meeting Start Time: " . $meeting->meeting_from);
            Log::info("Reminder Time (minutes): " . $reminderTime);
            Log::info("Current Time: " . Carbon::now());
            Log::info("Reminder Trigger Time: " . Carbon::parse($meeting->meeting_from)->subMinutes($reminderTime));
            if(Carbon::parse($meeting->meeting_from)->subMinutes($reminderTime)->lte(now()) ){

                $participantsEmails = [];

                if($meeting->meeting_participants == 'contacts'){
                    $contacts = \App\Models\Contact::whereIn('id',explode(',',$meeting->meeting_participants_id))->get();
                    $participantsEmails = array_merge($participantsEmails,$contacts->pluck('contact_email')->toArray());
                }elseif($meeting->meeting_participants == 'accounts'){
                    $accounts = \App\Models\Account::whereIn('id',explode(',',$meeting->meeting_participants_id))->get();
                    $participantsEmails = array_merge($participantsEmails,$accounts->pluck('account_email')->toArray());
                }elseif($meeting->meeting_participants == 'leads'){
                    $leads = \App\Models\Lead::whereIn('id',explode(',',$meeting->meeting_participants_id))->get();
                    $participantsEmails = array_merge($participantsEmails,$leads->pluck('lead_email')->toArray());
                }

                $participantsEmails = array_merge($participantsEmails,[$meeting->user->email]);

            $message = "This is Reminder.... Your Meeting Is Going To Start Be Prepare For it";
             Notification::send($user, new MeetingReminderNotification($meeting,$message));
             Mail::to($participantsEmails)->send(new MeetingReminderMail($meeting));
            $reminderSent = 'true';
            Log::info("reminderSent: $reminderSent");
            Log::info("All meeting participants' emails: " . implode(', ', $participantsEmails));
            $meeting->update([
                'meeting_reminder_status' => 'true'
            ]);
        }        
    }

    }



    protected function parseReminderTime($reminder){
        if(str_contains($reminder,'Minutes')){
            return (int) filter_var($reminder, FILTER_SANITIZE_NUMBER_INT);
        }elseif(str_contains($reminder, 'Hour')){
            return (int) filter_var($reminder, FILTER_SANITIZE_NUMBER_INT) * 60;
        }elseif(str_contains($reminder, 'Day')){
            return (int) filter_var($reminder, FILTER_SANITIZE_NUMBER_INT) * 1440;
        }
        return 0;
    }
}
