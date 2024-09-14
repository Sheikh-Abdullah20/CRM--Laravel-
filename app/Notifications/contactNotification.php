<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class contactNotification extends Notification
{
    use Queueable;

   public $contact;
   public $message;
    public function __construct($contact,$message)
    {
        $this->contact = $contact;
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
            'message' => $this->message . ' ( ' . $this->contact->contact_name . ' ) ', 
            'contact_id' => $this->contact->id,
            'creator_id' => $this->contact->creator_id
        ];
    }
}
