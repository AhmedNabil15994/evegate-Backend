<?php

namespace Modules\QSale\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Core\Traits\DataTable;
use Illuminate\Http\Request;
use Modules\QSale\Transformers\Dashboard\CoinTransactionResource;

class CoinController extends Controller
{
    use CrudDashboardController;

    public function coinsTransactionsIndex()
    {
        return $this->view('transactions');
    }

    public function coinsTransactionsDatatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->repository->coinsTransactionsQueryTable($request));
        $datatable['data'] = CoinTransactionResource::collection($datatable['data']);
        return Response()->json($datatable);
    }
}
