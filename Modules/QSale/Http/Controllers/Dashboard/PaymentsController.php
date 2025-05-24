<?php

namespace Modules\QSale\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\QSale\Transformers\Dashboard\PaymentResource as ModelResource;
use Modules\QSale\Repositories\Dashboard\PaymentRepository as Repo;

class PaymentsController extends Controller
{
    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return view('qsale::dashboard.payments.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->repo->QueryTable($request));

        $datatable['data'] = ModelResource::collection($datatable['data']);

        return Response()->json($datatable);
    }
}
