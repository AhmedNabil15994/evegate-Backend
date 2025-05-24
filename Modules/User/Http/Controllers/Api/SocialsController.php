<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Http\Request;

use Modules\User\Enums\SocialType;
use Modules\Apps\Http\Controllers\Api\ApiController;

class SocialsController extends ApiController
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        return array_map(function ($social) {
            return [
                "name"   => $social ,
            ];
        }, array_values(SocialType::getConstList()));
    }
}
