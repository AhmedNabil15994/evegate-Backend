<?php

namespace Modules\QSale\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;

class TeirResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        if($request->platform && $request->platform == 'android'){
            $id = $this->google_tier_id;
        }else{

            $id = $this->tier_id;
        }

        return [
            "id" => $id,
            "price" => $this->price . (setting('default_currency') == "USD" ? "$" : setting('default_currency')),
        ];
    }
}
