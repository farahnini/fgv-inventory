<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StoreItemNotification extends Notification
{
    use Queueable;

    // 1. Local variable
    public $details;

    /**
     * Create a new notification instance.
     */

     // 2. Dekat parameter terima detail
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */

     // 3. Nak hantar emel atau database atau dua2. Dalam kes ni database
    public function via(object $notifiable): array
    {   

        //
        // return ['mail','database'];

        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */

     // 4. Store in array
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->details['message'],
        ];
    }
}
