<?php

namespace Modules\User\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\User\Transformers\Vendor\WorkerResource;
use Modules\User\Http\Requests\Vendor\WorkerStoreRequest;
use Modules\User\Repositories\Vendor\WorkerRepository as User;
use Modules\Authorization\Repositories\Dashboard\RoleRepository as Role;

class WorkerController extends Controller
{
    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index()
    {
        return view('user::vendor.workers.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->user->QueryTable($request));

        $datatable['data'] = WorkerResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $roles = $this->role->getAllWorkersRoles('id','asc');
        return view('user::vendor.workers.create',compact('roles'));
    }

    public function store(WorkerStoreRequest $request)
    {
        try {
            $create = $this->user->create($request);

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
        $user = $this->user->findById($id, ["workerProfile"]);
        abort_if(is_null($user), "404");
        return view('user::vendor.users.view', compact('user'));
    }

    public function edit($id)
    {
      
        $user = $this->user->findById($id, ["workerProfile", "roles"]);
        
        abort_if(is_null($user), "404");
        $roles = $this->role->getAllWorkersRoles('id','asc');
     
        return view('user::vendor.workers.edit', compact('user', "roles"));
    }

    public function update(WorkerStoreRequest $request, $id)
    {
        try {
            $update = $this->user->update($request, $id);

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
            $delete = $this->user->delete($id);

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
            $deleteSelected = $this->user->deleteSelected($request);

            if ($deleteSelected) {
                return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
