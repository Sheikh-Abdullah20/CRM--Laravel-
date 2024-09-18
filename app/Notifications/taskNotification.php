<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class taskNotification extends Notification
{
    use Queueable;

    public $task;
    public $message;

    public function __construct($task,$message)
    {
        $this->task = $task;
        $this->message = $message;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->message . ' ' . $this->task->subject,
            'task_id' => $this->task->id,
        ];
    }
}
