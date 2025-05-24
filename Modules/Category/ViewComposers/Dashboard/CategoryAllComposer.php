<?php

namespace Modules\Category\ViewComposers\Dashboard;

use Modules\Category\Repositories\Dashboard\CategoryRepository as Category;
use Illuminate\View\View;
use Cache;

class CategoryAllComposer
{
    public $categories = [];

    public function __construct(Category $category)
    {
        $this->categories =  $category->getAll();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories' , $this->categories);
    }
}
