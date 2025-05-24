<?php

namespace Modules\Page\Repositories\Api;

use Modules\Page\Entities\Page;

class PageRepository
{
    function __construct(Page $page)
    {
        $this->page   = $page;
    }

    public function getAllActivePaginate($order = 'id', $sort = 'desc')
    {
        $pages = $this->page->active()->orderBy($order, $sort)->get();
        return $pages;
    }

    public function findById($id)
    {
        $page = $this->page->active()->where('id',$id)->first();
        return $page;
    }

    public function  pageSetting(){
        $ids = [];
        $aboutUs = setting('other','about_us');
        if($aboutUs) array_push($ids, $aboutUs); 
        $term =setting('other','terms');
        if($term) array_push($ids, $term); 
        return $this->page->whereIn("id", $ids)->get();
    }
}
