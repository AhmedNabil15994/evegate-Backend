<?php

namespace Modules\QSale\Transformers\Dashboard;

use  Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"            => $this->id ,
            "name"          => $this->name,
            "code"          => $this->code,
            "status"        => $this->status ,
            "max_use"       => $this->max_use,
            "max_use_user"  => $this->max_use_user,
            "current_use"   => $this->current_use,
            "is_fixed"      => $this->is_fixed,
            "amount"        => $this->amount,
            "min"           => $this->min ,
            "max"           => $this->max,
            "expired_at"    => $this->expired_at,
            "created_at"    => $this->created_at->format("d-m-Y"),
        ];
    }
}
