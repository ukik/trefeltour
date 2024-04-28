<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyClientToAdminNotification extends Notification
{
    use Queueable;

    public $user = null;
    public $category = null;
    public $table = null;
    public $payload = null;
    public $title = null;

    public function __construct($user, $category = null, $table = null, $payload = null, $title = null)
    {
        $this->user = $user;
        $this->category = $category;
        $this->table = $table;
        $this->payload = $payload;
        $this->title = $title;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {

        unset($this->user['permissions']);

        return [
            // 'data' =>' Your deposit of '. $this->amount.' was successful'
            'title' => $this->title,
            'isRead' => false,
            'style' => '',
            'sender' => $this->user,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'category' => $this->category,
            'table' => $this->table,
            'content' => $this->payload,
        ];
    }
}
