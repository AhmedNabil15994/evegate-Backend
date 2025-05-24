<?php

namespace Modules\QSale\Repositories\Dashboard;

use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\QSale\Entities\UserCoin;

class CoinRepository extends CrudRepository
{

    public function coinsTransactionsQueryTable($request)
    {

        $query = UserCoin::where(function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->input('search.value') . '%');
        });

        if (isset($request['req']['user_id']) && $request['req']['user_id']) {
            $query->where('user_id', $request['req']['user_id']);
        }

        $query = $this->filterDataTable($query, $request);
        return $query;
    }
}
