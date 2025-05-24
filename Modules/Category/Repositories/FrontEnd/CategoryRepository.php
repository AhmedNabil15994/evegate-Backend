<?php
namespace Modules\Category\Repositories\FrontEnd;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Category\Entities\Category;

class CategoryRepository
{
    protected $category;
   

    public function __construct(Category $category)
    {
        $this->category = $category;
    }


    public function mainCategories($order = 'id', $sort = 'desc')
    {
        return $this->category->mainCategories()
                        ->withCount([
                            "children"=>fn ($query) =>$query->active() ,
                            "ads"=>fn ($query) =>$query->allowShow() ,
                            ])
                        ->orderBy($order, $sort)->get();
    }
    
    public function findBySlug($slug, $with=[], $withCount)
    {
        return $this->category
            ->active()
            ->with($with)
            ->withCount($withCount)
            ->whereTranslation('slug', $slug)->firstOrFail();
    }
}
