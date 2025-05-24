<?php

namespace Modules\Apps\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Order\Repositories\Vendor\OrderRepository;
use Modules\Vendor\Repositories\Vendor\OfferRepository;
use Modules\Vendor\Repositories\Vendor\VendorRepository;
use Modules\OnDiet\Http\Requests\Dashboard\VendorRequest;
use Modules\OnDiet\Repositories\Vendor\CurrencyRepository;
use Modules\OnDiet\Repositories\Vendor\TransformRepository;
use Modules\OnDiet\Repositories\Vendor\VendorRepository as Vendor;

class VendorController extends Controller
{
    protected $vendorStatuses;
    protected $vendor;

    function __construct(Vendor $vendor)
    {
        $this->vendor = $vendor;
    }

    public function index()
    {
       
        $vendor = optional(auth()->user()->workerProfile)->vendor;
        $statisticData = $this->vendor->getStatistics();

     
        return view('apps::vendor.index', compact("vendor", "statisticData"));
    }

    public function editVendorInfo(Request $request)
    {
        $model = $this->vendor->findById($request->id, ["currencies"]);
        if (!$model)
            abort(404);
        return view('apps::vendor.edit', compact('model'));
    }

    public function updateVendorInfo(VendorRequest $request, $id)
    {
        try {
            $update = $this->vendor->updateInfo($request, $id);

            if ($update) {
                return Response()->json([true,  __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([false,__('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

}
