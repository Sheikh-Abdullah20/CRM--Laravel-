<?php

namespace App\Console\Commands;

use App\Mail\TaskReminderMail;
use App\Models\Task;
use App\Models\User;
use App\Notifications\taskNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class taskReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:task-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Task reminder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::where('reminder','true')->where('reminder_sent','false')->get();

        foreach($tasks as $task){
            $user = User::all();
            $current_time = Carbon::now();
            $reminder_time = Carbon::parse($task->reminder_time);
            $diffInReminder = $current_time->diffInMinutes($reminder_time);
            $thresHold = 1;
            Log::info("Current Time: " . $current_time);
            Log::info("Reminder Time: " . $reminder_time);
            Log::info("Difference: " . $diffInReminder);

            if($diffInReminder <= $thresHold){
                $task->update([
                    'reminder_sent' => 'true'
                ]);
                $message = "Task Reminder";
                Notification::send($user, new taskNotification($task,$message));
                Mail::to($task->user->email)->send(new TaskReminderMail($task));
                Log::info('Reminder Sent : '. $task);
            }
        }
    }
}
