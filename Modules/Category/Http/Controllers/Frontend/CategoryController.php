<?php
namespace Modules\Category\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Repositories\FrontEnd\CategoryRepository;

class CategoryController extends Controller
{
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }


    public function show(Request $request, $slug)
    {
        $category = $this->category->findBySlug($slug, [
                    "children"=>fn ($query) =>$query
                                                ->withCount([
                                                        "ads"=> fn ($query) =>$query->allowShow() ,
                                                        "children"=>fn ($query) =>$query->active()
                                                ])
                                                ->active(),
                   ], [
            "ads"        => fn ($query) =>$query->allowShow()
        ]);
        
        return view("category::frontend.show", compact("category"));
    }

    public function index(Request $request)
    {
        $categories = $this->category->mainCategories();
        return view("category::frontend.index", compact("categories"));
    }
}
