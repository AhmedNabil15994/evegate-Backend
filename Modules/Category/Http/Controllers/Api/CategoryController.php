<?php

namespace Modules\Category\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\User\Transformers\Api\WokerResource;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Category\Transformers\Api\CategoryResource;
use Modules\Category\Repositories\Api\CategoryRepository as Category;

class CategoryController extends ApiController
{
    public $categories;
    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }

    public function categories(Request $request)
    {
        $categories =  $this->categories->getAllCategories($request);

        return $this->response(CategoryResource::collection($categories));
    }

    public function child(Request $request, $id)
    {
        $categories =  $this->categories->listChildren($id, $request);

        return $this->response(CategoryResource::collection($categories));
    }

    public function show(Request $request, $id)
    {
        $category =  $this->categories->show($request, $id);
        abort_if(is_null($category), 404);

        return $this->response(new CategoryResource($category));
    }

    public function tree(Request $request)
    {
        $categories = $this->categories->tree();

        return $this->response(CategoryResource::collection($categories));
    }
}
