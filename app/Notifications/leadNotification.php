<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class leadNotification extends Notification
{
    use Queueable;
    public $lead;
    public $message;

    public function __construct($lead,$message)
    {
        $this->lead = $lead;
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
            'message' => $this->message . ' ( ' . $this->lead->first_name . ' '. $this->lead->last_name . ' ) ',
            'lead_id' => $this->lead->id,
            'creator_id' => $this->lead->creator_id
        ];
    }
}
