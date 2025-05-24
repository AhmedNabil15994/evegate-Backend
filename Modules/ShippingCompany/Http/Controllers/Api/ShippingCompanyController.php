<?php

namespace Modules\ShippingCompany\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\ShippingCompany\Transformers\Api\ShippingCompanyResource;

use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\ShippingCompany\Repositories\Api\ShippingCompanyRepository as Repo;


class ShippingCompanyController extends ApiController
{
    public $repo;
    function __construct(Repo $repo)
    {

        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        $shipping_companies =  $this->repo->getAll($request);
        return $this->responsePagnation(
            ShippingCompanyResource::collection($shipping_companies)
        );
    }

    public function view(Request $request, $id)
    {

        $shipping_company  =  $this->repo->findById($id);

        return $this->response(
            new ShippingCompanyResource($shipping_company)
        );
    }
}
