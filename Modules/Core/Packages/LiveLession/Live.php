<?php
namespace Modules\Core\Packages\LiveLession;

use Illuminate\Support\Facades\Facade;
use Modules\Core\Packages\LiveLession\LiveInterface;


class Live extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return LiveInterface::class; }
}
