<?php

namespace Modules\Core\Packages\Channel;

use Illuminate\Notifications\Notification;
use Modules\DeviceToken\Traits\FCMTraitUserTokens;

class FcmChannelToken
{
    use FCMTraitUserTokens;
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
        $this->sendForUser($notifiable, $message);
    }
}
