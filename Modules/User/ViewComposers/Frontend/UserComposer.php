<?php

namespace Modules\User\ViewComposers\Frontend;

use Cache;
use Illuminate\View\View;
use Modules\User\Repositories\Frontend\UserRepository;

class UserComposer
{
    public $usersCount = 0;

    public function __construct(UserRepository $user)
    {
        $this->usersCount =  $user->usersCount();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('usersCount', $this->usersCount);
    }
}
