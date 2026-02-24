<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AdminMessageNotification extends Notification
{
    use Queueable;

    public $title;
    public $message;
    public $originalTitle;
    public $originalMessage;
    public $languageCode;
    public $country;

    public function __construct($title, $message, $originalTitle = null, $originalMessage = null, $languageCode = 'en', $country = null)
    {
        $this->title = $title;
        $this->message = $message;
        $this->originalTitle = $originalTitle;
        $this->originalMessage = $originalMessage;
        $this->languageCode = $languageCode;
        $this->country = $country;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

   public function toMail($notifiable)
{
    try {
        $actionUrl = route('user_dashboard');
    } catch (\Exception $e) {
        $actionUrl = url('/user/dashboard');
    }

    return (new MailMessage)
        ->subject($this->title)
        ->view('admin.admin-email-send-message', [
            'subject' => $this->title,
            'userName' => $notifiable->name,
            'messageBody' => $this->message,
            'originalTitle' => $this->originalTitle,
            'originalMessage' => $this->originalMessage,
            'languageCode' => $this->languageCode,
            'country' => $this->country,
            'actionUrl' => $actionUrl,
            'actionText' => 'View Dashboard',
            'previewText' => 'You have a new message from MarketMind'
        ]);
}
}