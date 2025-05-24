<?php

namespace Modules\QSale\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\QSale\Http\Requests\Dashboard\CouponRequest as ModelRequest;
use Modules\QSale\Transformers\Dashboard\CouponResource as ModelResource;
use Modules\QSale\Repositories\Dashboard\CouponRepository as Repo;
use Modules\QSale\Repositories\Dashboard\PackageRepository;

class CouponController extends Controller
{

    public $packageRepository;
    public $repo;
    function __construct(Repo $repo, PackageRepository $packageRepository)
    {
        $this->repo = $repo;
        $this->packageRepository = $packageRepository;
    }

    public function index()
    {

        return view('qsale::dashboard.coupons.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->repo->QueryTable($request));

        $datatable['data'] = ModelResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $packages = $this->packageRepository->getAll();
        return view('qsale::dashboard.coupons.create', compact('packages'));
    }

    public function store(ModelRequest $request)
    {
        try {
            $create = $this->repo->create($request);

            if ($create) {
                return Response()->json([true, __('apps::dashboard.messages.created')]);
            }

            return Response()->json([true, __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function show($id)
    {
        return view('qsale::dashboard.coupons.show');
    }

    public function edit($id)
    {
        $model = $this->repo->findById($id);
        $packages = $this->packageRepository->getAll();


        return view('qsale::dashboard.coupons.edit', compact('model', 'packages'));
    }

    public function update(ModelRequest $request, $id)
    {
        try {
            $update = $this->repo->update($request, $id);

            if ($update) {
                return Response()->json([true, __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([true, __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function destroy($id)
    {
        try {
            $delete = $this->repo->delete($id);

            if ($delete) {
                return Response()->json([true, __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true, __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function deletes(Request $request)
    {
        try {
            $deleteSelected = $this->repo->deleteSelected($request);

            if ($deleteSelected) {
                return Response()->json([true, __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true, __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
