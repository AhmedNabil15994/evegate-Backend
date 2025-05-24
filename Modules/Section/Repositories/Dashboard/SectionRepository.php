<?php

namespace Modules\Section\Repositories\Dashboard;

use Modules\Section\Entities\Section;
use Hash;
use DB;

class SectionRepository
{

    function __construct(Section $section)
    {
        $this->section   = $section;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $sections = $this->section->active()->orderBy($order, $sort)->get();
        return $sections;
    }

    public function getStatistics()
    {
        $count  = $this->section->count();
        return ["count" => $count];
    }


    public function getAll($order = 'id', $sort = 'desc')
    {
        $sections = $this->section->orderBy($order, $sort)->get();
        return $sections;
    }

    public function findById($id)
    {
        $section = $this->section->withDeleted()->find($id);
        return $section;
    }

    public function create($request)
    {
        DB::beginTransaction();

        try {

            $image = $request->image ? pathFileInStorage($request, "image", "sections") : "/uploads/default.png";
            $section = $this->section->create([
                'status'         => $request->status ? 1 : 0,
                'color'          => $request->color,
                "image"          => $image,

            ]);

            $this->translateTable($section, $request);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();

        $section = $this->findById($id);
        $restore = $request->restore ? $this->restoreSoftDelte($section) : null;
        $image =   $section->image;
        if ($request->image) {
            deleteFileInStroage($section->image);
            $image = pathFileInStorage($request, "image", "sections");
        }



        try {

            $section->update([
                'status'         => $request->status ? 1 : 0,
                'color'          => $request->color,
                "image"          => $image,

            ]);

            $this->translateTable($section, $request);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function restoreSoftDelte($model)
    {
        $model->restore();
    }

    public function translateTable($model, $request)
    {
        foreach ($request['title'] as $locale => $value) {
            $model->translateOrNew($locale)->title           = $value;
            $model->translateOrNew($locale)->slug            = slugfy($value);
            $model->translateOrNew($locale)->description     = $request['description'][$locale];
        }

        $model->save();
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {

            $model = $this->findById($id);

            if ($model->trashed()) :
                deleteFileInStroage($model->image);
                $model->forceDelete();

            else :
                $model->delete();
            endif;

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function deleteSelected($request)
    {
        DB::beginTransaction();

        try {

            foreach ($request['ids'] as $id) {
                $model = $this->delete($id);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function QueryTable($request)
    {
        $query = $this->section->withDeleted()->where(function ($query) use ($request) {

            $query->where('id', 'like', '%' . $request->input('search.value') . '%');

            $query->orWhere(function ($query) use ($request) {

                $query->whereHas('translations', function ($query) use ($request) {

                    $query->where('description', 'like', '%' . $request->input('search.value') . '%');
                    $query->orWhere('title', 'like', '%' . $request->input('search.value') . '%');
                    $query->orWhere('slug', 'like', '%' . $request->input('search.value') . '%');
                });
            });
        });

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    public function filterDataTable($query, $request)
    {
        // Search Sections by Created Dates
        if (isset($request['req']['from']) && $request['req']['from'] != '')
            $query->whereDate('created_at', '>=', $request['req']['from']);

        if (isset($request['req']['to']) && $request['req']['to'] != '')
            $query->whereDate('created_at', '<=', $request['req']['to']);

        if (isset($request['req']['deleted']) &&  $request['req']['deleted'] == 'only')
            $query->onlyDeleted();

        if (isset($request['req']['deleted']) &&  $request['req']['deleted'] == 'with')
            $query->withDeleted();

        if (isset($request['req']['status']) &&  $request['req']['status'] == '1')
            $query->active();

        if (isset($request['req']['status']) &&  $request['req']['status'] == '0')
            $query->unactive();

        return $query;
    }
}
