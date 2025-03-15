<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConfirmCooker extends Notification
{
    use Queueable;
    private $cooker_id;
    private $cooker_name;

    public function __construct($cooker_id, $cooker_name)
    {
        $this->cooker_id =$cooker_id;
        $this->cooker_name =$cooker_name;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title'=>'تأكيد الايميل',
            'cooker_id'=>$this->cooker_id,
            'cooker_name'=>$this->cooker_name,
        ];
    }
}
