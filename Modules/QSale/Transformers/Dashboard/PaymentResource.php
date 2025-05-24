<?php

namespace Modules\QSale\Transformers\Dashboard;

use  Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return  [
            "id"                => $this->id,
            "user_id"           => $this->user->name,
            "total"             => $this->total,
            "ads"               => optional(optional($this->order)->ads)->title,
            "status"            => optional(__('qsale::dashboard.payments.status'))[$this->status],
            "created_at"        => $this->created_at->format("d-m-Y"),
        ];
    }
}
