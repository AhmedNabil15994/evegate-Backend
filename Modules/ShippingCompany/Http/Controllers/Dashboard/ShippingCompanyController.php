<?php

namespace Modules\ShippingCompany\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\ShippingCompany\Http\Requests\Dashboard\ShippingCompanyRequest as ModelRequest;
use Modules\ShippingCompany\Repositories\Dashboard\ShippingCompanyRepository as Repo;
use Modules\ShippingCompany\Transformers\Dashboard\ShippingCompanyResource as ModelResource;

class ShippingCompanyController extends Controller
{

  function __construct(Repo $repo)
  {
    $this->repo = $repo;
  }

  public function index()
  {

    return view('shipping_company::dashboard.index');
  }

  public function datatable(Request $request)
  {
    $datatable = DataTable::drawTable($request, $this->repo->QueryTable($request));

    $datatable['data'] = ModelResource::collection($datatable['data']);

    return Response()->json($datatable);
  }

  public function create()
  {

    return view('shipping_company::dashboard.create');
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
    return view('shipping_company::dashboard.show');
  }

  public function edit($id)
  {
    $model = $this->repo->findById($id);
    return view('shipping_company::dashboard.edit', compact('model'));
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
