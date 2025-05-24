<?php

namespace Modules\Section\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Section\Transformers\Api\SectionResource;

use Modules\Section\Repositories\Api\SectionRepository as Section;

class SectionController extends ApiController
{

    function __construct(Section $section)
    {
        $this->section = $section;
    }

    public function sections()
    {
        $sections =  $this->section->getAllActive();


        return SectionResource::collection($sections);
    }
}
