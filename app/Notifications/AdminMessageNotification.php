<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AdminMessageNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $title;
    public $message;

    public function __construct($title, $message)
    {
        $this->title = $title;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'created_at' => now(),
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->title)
           
                 ->view('admin.admin-email-send-message', [
                'subject' => $this->title,
                'messageBody' => $this->message,
                'userName' => $notifiable->name,
                'actionText' => 'View My Account',
                'previewText' => substr($this->message, 0, 50)
            ]);
    }
}