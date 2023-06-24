<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserFollowNotification extends Notification
{
    use Queueable;
    private $paids;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    // public $paid;
    public function __construct($paid)
    {
        // dd($paid);
        // $paid['name'];
        $this->paids = $paid['paid'];

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];

    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    
    public function toArray($notifiable)
    {
        // dd($notifiable);
        return [
            'user' => $notifiable['name'],
            'paid' => $this->paids,
            // 'pay' => $notifiable->pay,
            'time' => now()->toDateTimeString(),
        ];
    }
}
