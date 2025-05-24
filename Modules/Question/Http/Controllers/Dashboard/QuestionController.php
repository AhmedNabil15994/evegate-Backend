<?php

namespace Modules\Question\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Question\Repositories\Api\QuestionRepositry;
use Modules\Question\Http\Requests\Dashboard\QuestionStoreRequest;
use Modules\Question\Repositories\Dashboard\QuestionRepository as Repositry ;;
use Modules\Question\Transformers\Dashboard\QuestionResource as ModelResource;

class QuestionController extends Controller
{
    function __construct(Repositry $businessRequest)
    {
       $this->repo = $businessRequest;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('question::dashboard.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request,$this->repo->QueryTable($request));

        $datatable['data'] = ModelResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        
        return view('question::dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(QuestionStoreRequest $request)
    {
        //
         try {
            $create =$this->repo->create($request);

            if ($create) {
              return Response()->json([true , __('apps::dashboard.messages.created')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $model =$this->repo->findById($id);
        return view('question::dashboard.edit')->with(["question"=>$model]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(QuestionStoreRequest $request, $id)
    {
        //
        try {
            $update =$this->repo->update($request,$id);

            if ($update) {
              return Response()->json([true , __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
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
