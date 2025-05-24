<?php

namespace Modules\Page\Transformers\Api;

use Illuminate\Http\Resources\Json\ResourceCollection;


class PagePaginateResource extends ResourceCollection
{
    public $collects = PageResource::class;

    public function toArray($request)
    {
        return [
            'pages'      => $this->collection,
            'pagination' => [
                'size' => $this->perPage(),
                'total' => $this->total(),
                'current' => $this->currentPage(),
            ],
       ];
    }
}
