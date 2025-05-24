<?php

namespace Modules\QSale\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\QSale\Http\Requests\Dashboard\RepublishedPackageRequest as ModelRequest;
use Modules\QSale\Repositories\Dashboard\RepublishedPackageRepository as Repo ;
use Modules\QSale\Transformers\Dashboard\RepublishedPackageResource as ModelResource;

class RepublishedPackageController extends Controller
{

    function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
       
       
        return view('qsale::dashboard.republished_packages.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->repo->QueryTable($request));

        $datatable['data'] = ModelResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
       
        return view('qsale::dashboard.republished_packages.create');
    }

    public function store(ModelRequest $request)
    {
        try {
            $create = $this->repo->create($request);

            if ($create) {
                return Response()->json([true , __('apps::dashboard.messages.created')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function show($id)
    {
        return view('qsale::dashboard.republished_packages.show');
    }

    public function edit($id)
    {
        $model = $this->repo->findById($id);
        return view('qsale::dashboard.republished_packages.edit',compact('model'));
    }

    public function update(ModelRequest $request, $id)
    {
        try {
            $update = $this->repo->update($request,$id);

            if ($update) {
                return Response()->json([true , __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function destroy($id)
    {
        try {
            $delete = $this->repo->delete($id);

            if ($delete) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function deletes(Request $request)
    {
        try {
            $deleteSelected = $this->repo->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
