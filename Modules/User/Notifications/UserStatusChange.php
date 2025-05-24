<?php

namespace Modules\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Core\Packages\Channel\FcmChannel;
use Modules\Core\Packages\Channel\FcmChannelToken;

class UserStatusChange extends Notification  implements ShouldQueue
{
    use Queueable;
    const TYPES =  [
        "not_verified",  //0
        "verified",  //1
        "active",  //2
        "unactive", //3
        "delete", // 4
        "admin_verified", // 5
    ];
    public $type, $actionId;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($type)
    {
        //
        $this->type = self::TYPES[$type];
        $this->actionId          = -1;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [FcmChannelToken::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', 'https://laravel.com')
            ->line('Thank you for using our application!');
    }

    public function toFcm($notifiable)
    {
        $fcmData =   [
            "id"           => $this->actionId,
            "type"         => $this->type
        ];

        $title = [];
        $description = [];
        foreach (config('translatable.locales') as $lang) {
            $title[$lang]        = __("devicetoken::fcm.status.{$this->type}.title", [], $lang);
            $description[$lang]  = __("devicetoken::fcm.status.{$this->type}.description", [], $lang);
        }
        return array_merge($fcmData, [
            "title" => $title,
            "description" => $description
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
