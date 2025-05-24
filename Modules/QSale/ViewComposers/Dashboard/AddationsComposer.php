<?php

namespace Modules\QSale\ViewComposers\Dashboard;

use Modules\QSale\Repositories\Dashboard\AddationRepository as Repo;
use Illuminate\View\View;


class AddationsComposer
{
    public $addations = [];

    public function __construct(Repo $repo)
    {
        
        $this->addations =  $repo->getAllActive();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('addations' , $this->addations);
    }
}
