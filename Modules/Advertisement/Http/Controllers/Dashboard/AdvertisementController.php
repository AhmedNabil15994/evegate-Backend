<?php

namespace Modules\Advertisement\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Advertisement\Http\Requests\Dashboard\AdvertisementRequest as ModelRequest;
use Modules\Advertisement\Transformers\Dashboard\AdvertisementResource;
use Modules\Advertisement\Repositories\Dashboard\AdvertisementRepository as Repo;

class AdvertisementController extends Controller
{

    function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return view('advertisement::dashboard.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->repo->QueryTable($request));

        $datatable['data'] = AdvertisementResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $ads = $this->repo->getAdsToSlide();
        return view('advertisement::dashboard.create',compact("ads"));
    }

    public function store(ModelRequest $request)
    {
        try {
            $create = $this->repo->create($request);

            if ($create) {
                return Response()->json([true ,  __('apps::dashboard.messages.created') ]);
            }

            return Response()->json([false  , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function show($id)
    {
        return view('advertisement::dashboard.show');
    }

    public function edit($id)
    {
        $advertisement = $this->repo->findById($id);
        $ads = $this->repo->getAdsToSlide();

        return view('advertisement::dashboard.edit',compact('advertisement', "ads"));
    }

    public function update(ModelRequest $request, $id)
    {
        try {
            $update = $this->repo->update($request,$id);

            if ($update) {
                return Response()->json([true ,__('apps::dashboard.messages.updated')]);
            }

            return Response()->json([false  , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function destroy($id)
    {
        try {
            $delete = $this->repo->delete($id);

            if ($delete) {
                return Response()->json([true , __('apps::dashboard.messages.deleted') ]);
            }

            return Response()->json([false  , __('apps::dashboard.messages.failed')]);
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

            return Response()->json([false  , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
