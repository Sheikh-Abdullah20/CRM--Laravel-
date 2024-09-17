<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MeetingNotification extends Notification
{
    use Queueable;

    public $meeting;
    public $message;
    public function __construct($meeting,$message)
    {
        $this->meeting = $meeting;
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
            'message' => $this->message . ' ' . $this->meeting->meeting_name,
            'meeting_id' => $this->meeting->id
        ];
    }
}
