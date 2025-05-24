<?php

namespace Modules\QSale\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Modules\QSale\Entities\Ads;
use Illuminate\Routing\Controller;
use Modules\QSale\Entities\Addation;
use Modules\QSale\Repositories\Dashboard\AdsAddationRepository as Repo;
use Modules\QSale\Http\Requests\Dashboard\AdsAddationRequest as ModelRequest;


class AdsAdditionsController extends Controller
{
    public $repo;

    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    public function add(Ads $ads)
    {
        $ads = $ads->load('addations');
        $addations = Addation::whereNotIn('id', $ads->addations->pluck('addation_id'))->get();
        return view('qsale::dashboard.ads.additions.create', compact('ads', 'addations'));
    }
    public function store(Ads $ads, ModelRequest $request)
    {
        try {
            $create = $this->repo->create($request, $ads);
            if ($create) {
                return Response()->json([true, __('apps::dashboard.messages.created')]);
            }
            return Response()->json([true, __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }


    public function edit(Ads $ads)
    {
        $ads = $ads->load('addations');

        return view('qsale::dashboard.ads.additions.edit', compact('ads'));
    }
    public function update(Ads $ads, ModelRequest $request)
    {

        try {
            $update = $this->repo->update($request, $ads);
            if ($update) {
                return Response()->json([true, __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([true, __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
