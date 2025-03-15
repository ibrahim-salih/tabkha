<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCooker extends Notification
{
    use Queueable;
    private $cooker_id;
    private $cooker_name;

    /**
     * Create a new notification instance.
     */
    public function __construct($cooker_id, $cooker_name)
    {
        $this->cooker_id =$cooker_id;
        $this->cooker_name =$cooker_name;
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

    public function toDatabase($notifiable)
    {
        return [
            'title'=>'طباخ جديد',
            'cooker_id'=>$this->cooker_id,
            'cooker_name'=>$this->cooker_name,
        ];
    }
    
}
