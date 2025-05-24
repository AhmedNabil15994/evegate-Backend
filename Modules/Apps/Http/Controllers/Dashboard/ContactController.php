<?php

namespace Modules\Apps\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Apps\Repositories\Dashboard\ConatactRepository as Repositry ;

;
use Modules\Apps\Transformers\Dashboard\ContactResource as ModelResource;

class ContactController extends Controller
{
    public function __construct(Repositry $businessRequest)
    {
        $this->repo = $businessRequest;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('apps::dashboard.contact.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->repo->QueryTable($request));

        $datatable['data'] = ModelResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        try {
            $delete =$this->repo->delete($id);

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
            $deleteSelected =$this->repo->deleteSelected($request);

            if ($deleteSelected) {
                return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
