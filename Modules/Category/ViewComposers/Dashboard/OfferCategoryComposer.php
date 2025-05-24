<?php

namespace Modules\Category\ViewComposers\Dashboard;

use Cache;
use Illuminate\View\View;
use Modules\Category\Enum\CategoryType;
use Modules\Category\Repositories\Dashboard\CategoryRepository as Category;

class OfferCategoryComposer
{
    public $data = [];

    public function __construct(Category $category)
    {
        // $this->data =  $category->getAllBasedType(CategoryType::OFFER);
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('offerCategories', $this->data);
    }
}
