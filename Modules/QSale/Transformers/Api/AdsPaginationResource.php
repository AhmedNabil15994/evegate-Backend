<?php

namespace Modules\QSale\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;

class AdsPaginationResource extends JsonResource
{
    public function toArray($request) : array
    {

        return [
            'data'       => AdsResource::collection($this->collection),
            'pagination' => [
                'total'       => $this->total(),
                'count'       => $this->count(),
                'perPage'     => $this->perPage(),
                'currentPage' => $this->currentPage(),
                'totalPages'  => $this->lastPage()
            ],
        ];
    }

    public function withResponse($request, $response)
    {
        $jsonResponse = json_decode($response->getContent(), true);
        unset($jsonResponse['links'],$jsonResponse['meta']);
        $response->setContent(json_encode($jsonResponse['data']));
    }
}
