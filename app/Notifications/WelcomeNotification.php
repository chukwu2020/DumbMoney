<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class WelcomeNotification extends Notification
{
    use Queueable;

    public $title;
    public $message;
    public $userName;
    public $userEmail;
    public $accountType;
    public $adminName;

    public function __construct($userName, $userEmail, $accountType, $adminName = null)
    {
        $this->title = 'Welcome to MarketMind!';
        $this->message = 'Your registration is complete. Start your trading journey today!';
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->accountType = $accountType;
        $this->adminName = $adminName;
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
            'type' => 'welcome',
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Welcome to MarketMind - Registration Complete!')
            ->view('emails.registration_complete', [
                'userName' => $this->userName,
                'userEmail' => $this->userEmail,
                'accountType' => $this->accountType,
                'adminName' => $this->adminName,
                
            ]);
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title' => $this->title,
            'message' => $this->message,
        ]);
    }
}