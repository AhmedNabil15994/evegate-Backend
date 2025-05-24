<?php

namespace Modules\Core\Packages\Channel;

use Illuminate\Notifications\Notification;
use Modules\DeviceToken\Traits\FCMTraitUser;

class FcmChannel
{
    use FCMTraitUser;
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toFcm($notifiable);

      
        $this->sendNotificationUser($notifiable, $message);
        // Send notification to the $notifiable instance...
        // dd($message, $notifiable);
    }
}