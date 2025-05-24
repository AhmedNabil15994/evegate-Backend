<?php

namespace Modules\User\ViewComposers\Frontend;


use Cache;
use Illuminate\View\View;
use Modules\User\Repositories\Frontend\UserRepository;

class FavoriteComposer
{
    public $favoritesCount = 0;

    public function __construct(UserRepository $user)
    {
        $this->favoritesCount =  $user->favoritesCount();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('favoritesCount' , $this->favoritesCount);
    }
}
