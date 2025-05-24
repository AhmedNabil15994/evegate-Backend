<?php

namespace Modules\QSale\Events;

use Illuminate\Queue\SerializesModels;

class PaiedEvent
{
    use SerializesModels;
    public $payment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($payment)
    {
        //
        $this->payment = $payment;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
