<?php

namespace Modules\Section\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Section\Http\Requests\Dashboard\SectionRequest;
use Modules\Section\Transformers\Dashboard\SectionResource;
use Modules\Section\Repositories\Dashboard\SectionRepository as Section;

class SectionController extends Controller
{

    function __construct(Section $section)
    {
        $this->section = $section;
    }

    public function index()
    {
       
        return view('section::dashboard.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->section->QueryTable($request));

        $datatable['data'] = SectionResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
       
        return view('section::dashboard.create');
    }

    public function store(SectionRequest $request)
    {
        try {
            $create = $this->section->create($request);

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
        return view('section::dashboard.show');
    }

    public function edit($id)
    {
        $section = $this->section->findById($id);
       
       

        return view('section::dashboard.edit',compact('section'));
    }

    public function update(SectionRequest $request, $id)
    {
        try {
            $update = $this->section->update($request,$id);

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
            $delete = $this->section->delete($id);

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
            $deleteSelected = $this->section->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
