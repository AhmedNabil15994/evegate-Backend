<?php

namespace Modules\Attribute\ViewComposers\Dashboard;

use Modules\Attribute\Repositories\Dashboard\AttributeRepository as Page;
use Illuminate\View\View;


class AttributeComposer
{
    public $pages = [];

    public function __construct(Page $page)
    {
        
        $this->pages =  $page->getAllActive();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('attributes' , $this->pages);
    }
}
