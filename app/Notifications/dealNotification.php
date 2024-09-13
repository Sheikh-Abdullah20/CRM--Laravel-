<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class dealNotification extends Notification
{
    use Queueable;

    public $deal;
    public $message;
    public function __construct($deal,$message)
    {
        $this->deal = $deal;
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
     * Get the mail representation of the notification.
     */
   

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->message . ' ( ' . $this->deal->deal_name . ' )',
            'deal_id' => $this->deal->id,
            'creator_id' => $this->deal->creator_id,
            
        ];
    }
}
