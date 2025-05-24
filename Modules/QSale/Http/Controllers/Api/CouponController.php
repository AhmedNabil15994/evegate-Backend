<?php

namespace Modules\QSale\Http\Controllers\Api;

use Illuminate\Http\Request;

use Modules\User\Enums\UserType;

use Modules\QSale\Entities\Coupon;

use Modules\QSale\Entities\Package;
use Modules\QSale\Transformers\Api\AdsResource;
use Modules\QSale\Http\Requests\Api\CouponRequest;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\QSale\Repositories\Api\CouponRepository as Repo;
use Modules\User\Transformers\Api\UserResource as ModelResource;

class CouponController extends ApiController
{
    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    public function check(CouponRequest $request)
    {
        $package = Package::where('id', $request->package_id)->first();
        $coupon = Coupon::where('code', $request->code)->first();
        $price = $package->price;

        $values = [
            'original_price' =>  $price,
            'after_apply_coupon_price' => (string)($price - $coupon->applyCoupon($price)),
        ];

        return $this->response($values);
    }
}
