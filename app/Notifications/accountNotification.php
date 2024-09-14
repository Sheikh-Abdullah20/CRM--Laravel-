<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class accountNotification extends Notification
{
    use Queueable;

    public $account;
    public $message;
    public function __construct($account,$message)
    {
        $this->account = $account;
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
                'message' => $this->message . ' ( ' . $this->account->account_name . ' ) ' ,  
                'account_id' => $this->account->id,
                'creator_id' => $this->account->creator_id
        ];
    }
}
