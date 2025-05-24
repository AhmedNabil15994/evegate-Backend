<?php

namespace Modules\Slider\Repositories\FrontEnd;

use Modules\Slider\Entities\Slider;

class SliderRepository
{
    public function __construct(Slider $slider)
    {
        $this->slider   = $slider;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        return $this->slider->active()->unexpired()->started()->inRandomOrder()->take(3)->get();
    }
}
