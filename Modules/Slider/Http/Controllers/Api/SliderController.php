<?php

namespace Modules\Slider\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Slider\Transformers\WebService\SliderResource;
use Modules\Apps\Http\Controllers\WebService\WebServiceController;
use Modules\Slider\Repositories\WebService\SliderRepository as Slider;

class SliderController extends ApiController
{
    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function slider(Request $request)
    {
        $slider =  $this->slider->getRandomPerRequest($request);

        return $this->response(SliderResource::collection($slider));
    }
}
