<?php

namespace App\Console\Commands;

use App\Mail\taskEndMail;
use App\Models\Task;
use App\Notifications\taskNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class taskendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:task_end_-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Task End Reminder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::where('reminder_sent','sent')->get();
        Log::info("End Task Reminder: " . $tasks->count());

       foreach($tasks as $task){
        $currentTime = Carbon::now();
        $due_date = Carbon::parse($task->due_date);

        $diff = $currentTime->diffInMinutes($due_date);
        $threshold = 1;
        Log::info($diff);

        if($diff <= $threshold){
            $task->update([
                'reminder_sent' => 'task_end'
            ]);

            $message = "Task End Reminder";
            Notification::send($task->user, new taskNotification($task,$message));
            Mail::to($task->user->email)->send(new taskEndMail($task));
            Log::info("Task End Reminder Sent");
        }

       }
        
    }
}
