<?php

namespace Modules\Section\Repositories\Api;

use Modules\Section\Entities\Section;


class SectionRepository
{
    function __construct(Section $section)
    {
        $this->section   = $section;
       
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $sections = $this->section->active()->orderBy($order, $sort)->get();
        return $sections;
    }

    

    public function findById($id, $with=[])
    {
        $section = $this->section->with($with)->active()->where('id',$id)->first();
        return $section;
    }

   


  
}
