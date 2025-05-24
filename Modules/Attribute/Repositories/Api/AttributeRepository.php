<?php

namespace Modules\Attribute\Repositories\Api;

use DB;
use Hash;
use Modules\Category\Entities\Category;
use Modules\Attribute\Entities\Attribute  as Model;

class AttributeRepository
{
    public function __construct(Model $model)
    {
        $this->model   = $model;
    }

  


    public function getAll(&$request, $order = 'id', $sort = 'asc')
    {
        $models = $this->model->active()
                      ->when($request->show_in_search, function ($query) {
                          $query->showInSearch()  ;
                      })
                      ->when($request->category_id, function ($query) use (&$request) {
                          $categories = [$request->category_id];
                          if ($request->has("with_parent_category")) {
                              $parent_id =  Category::whereAncestorOf($request->category_id)->whereIsRoot()->select("id")->pluck("id")->toArray();
                              $categories = array_merge($categories, $parent_id);
                          }
                          $query->whereHas("categories", function ($category) use (&$request, $categories) {
                              $category->whereIn("categories.id", $categories);
                          });
                      })
                      ->with(["optionsAllow"])
                     ->orderBy($order, $sort)
                     ->get();
        return $models;
    }

    public function findById($id, $with=[])
    {
        $model = $this->model->active()
                 ->showInSearch()->with($with)->findOrFail($id);
        return $model;
    }
}
