<?php

namespace Modules\Section\ViewComposers\Dashboard;

use Modules\Section\Repositories\Dashboard\SectionRepository as Section;
use Illuminate\View\View;
use Cache;

class SectionComposer
{
    public $sections = [];

    public function __construct(Section $section)
    {
        $this->sections =  $section->getAllActive();
        // dd("sss");
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('sections' , $this->sections);
    }
}
