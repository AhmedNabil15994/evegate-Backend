<?php

namespace Modules\Category\Repositories\Api;

use Modules\Category\Entities\Category;

class CategoryRepository
{
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAllCategories($request)
    {
        $categories = $this->category->baseFilter($request)
                                    ->active()
                                    ->when($request->country_id, fn ($query) => $query->where("country_id", $request->country_id))
                                    ->orderBy("sort", "asc")
                                    ->orderBy('id', 'DESC')
                                    ->get();
        return $categories;
    }

    public function getMainCategory()
    {
        return $this->category
                        ->mainCategories()
                        ->active()
                        ->with([
                            "children"=> function ($query) {
                                $query->active();
                            }
                        ])
                        ->orderBy("sort", "asc")
                        ->get();
    }

    public function show($request, $id)
    {
        $categories = $this->category->baseFilter($request)
                                    ->active()
                                    ->find($id);
        return $categories;
    }

    public function listChildren($id, $request)
    {
        $categories = $this->category->baseFilter($request)
                                    ->active()
                                    ->where("parent_id", $id)
                                    ->get();
    }

    public function findById($id, $with=[])
    {
        return $this->category->active()->find($id);
    }

    public function tree($request= null)
    {
        $request = $request?? request();
        $base =  $this->category
                         ->active()
                         ->with([
                             "children"=> function ($query) {
                                 $query->active();
                             }
                            ])
                            ->orderBy("sort", "asc");
        if ($request->type) {
            $base->where("type", $request->type);
        }
        return $base->get()->toTree();
    }
}
