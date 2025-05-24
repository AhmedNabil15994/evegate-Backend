<?php

namespace Modules\QSale\ViewComposers\Dashboard;

use Modules\QSale\Repositories\Dashboard\AdTypeRepository as Repo;
use Illuminate\View\View;


class AdTypeComposer
{
    public $ad_types = [];

    public function __construct(Repo $repo)
    {
        
        $this->ad_types =  $repo->getAllActive();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('ad_types' , $this->ad_types);
    }
}
