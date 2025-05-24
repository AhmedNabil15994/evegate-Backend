<?php
namespace Modules\Category\ViewComposers\FrontEnd;

use Modules\Category\Repositories\FrontEnd\CategoryRepository;
use Illuminate\View\View;

class CategoryComposer
{
    public $categories = [];

    public function __construct(CategoryRepository $category)
    {
        $this->categories =  $category->mainCategories();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('mainCategories', $this->categories);
    }
}
