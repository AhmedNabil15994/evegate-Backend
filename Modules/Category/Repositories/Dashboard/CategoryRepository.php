<?php

namespace Modules\Category\Repositories\Dashboard;

use DB;
use Modules\Category\Entities\Category;
use Modules\Category\Enum\CategoryType;

class CategoryRepository
{
    public function __construct(Category $category)
    {
        $this->category   = $category;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $categories = $this->category->orderBy($order, $sort)->get();

        return $categories;
    }
    public function getAllBasedType($type, $order = 'id', $sort = 'desc')
    {
        $categories = $this->category
            ->where("type", $type)
            ->orderBy($order, $sort)->get()->toTree();

        return $categories;
    }



    public function countCategories($order = 'id', $sort = 'desc')
    {
        $categories = $this->category->orderBy($order, $sort)->count();
        return $categories;
    }

    public function getStatistics()
    {
        $count  = $this->category->count();
        return ["count" => $count];
    }

    public function mainCategories($order = 'id', $sort = 'desc')
    {
        $categories = $this->category->mainCategories()->orderBy($order, $sort)->get();
        return $categories;
    }
    public function mainCategoriesBasedType($type, $order = 'id', $sort = 'desc')
    {
        $categories = $this->category
            ->where("type", $type)
            ->mainCategories()->orderBy($order, $sort)->get();
        return $categories;
    }

    public function findById($id)
    {
        $category = $this->category->withDeleted()->find($id);
        return $category;
    }

    public function create($request)
    {
        DB::beginTransaction();

        try {
            $image = $request->image ? pathFileInStorage($request, "image", "categories") : "/uploads/default.png";
            $category = $this->category->create([
                'image'         => $image,
                'status'        => $request->status ? 1 : 0,
                "is_end_category" => $request->is_end_category ? 1 : 0,
                "slim_details" => $request->slim_details ? 1 : 0,
                'color'         => $request->color,
                'parent_id'   => ($request->parent_id != "null") ? $request->parent_id : null,
                "price"         => $request->price ?? 0,
                "type"          => $request->type ?? CategoryType::NORMAL,
                "sort"          => $request->sort ?? "999",
                "country_id" => $request->country_id ?? config("customs.country_id")
            ]);

            $this->translateTable($category, $request);
            $this->category::fixTree();
            // dd($request->c_attributes ?? []);
            $category->attributes()->sync($request->c_attributes ?? []);

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

        $category = $this->findById($id);
        $restore = $request->restore ? $this->restoreSoftDelte($category) : null;
        $image =   $category->image;
        if ($request->image) {
            deleteFileInStroage($category->image);
            $image = pathFileInStorage($request, "image", "categories");
        }

        try {
            $category->update([
                'image'         => $image,
                'status'        => $request->status ? 1 : 0,
                "is_end_category" => $request->is_end_category ? 1 : 0,
                "slim_details" => $request->slim_details ? 1 : 0,
                'color'         => $request->color,
                'parent_id'     => ($request->parent_id != "null") ? $request->parent_id : null,
                "price"         => $request->price ?? 0,
                "sort"          => $request->sort ?? "999",
                "country_id" => $request->country_id ?? config("customs.country_id")
                //   "type"          => $request->type ?? CategoryType::NORMAL
            ]);

            $this->translateTable($category, $request);
            $this->category::fixTree();
            $category->attributes()->sync($request->c_attributes ?? []);

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
                $this->category::fixTree();
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
        // dd($request->input('search.value') );
        $query = $this->category->withDeleted()->with(['translations'])
            ->where(function ($query) use ($request) {
                $query->where('id', 'like', '%' . $request->input('search.value') . '%');
                $query->orWhereHas('translations', function ($query) use ($request) {
                    $query->Where('title', 'like', '%' . $request->input('search.value') . '%');
                    $query->orWhere('slug', 'like', '%' . $request->input('search.value') . '%');
                });
            });

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    public function filterDataTable($query, $request)
    {
        // Search Categories by Created Dates
        if (isset($request['req']['from']) && $request['req']['from'] != '') {
            $query->whereDate('created_at', '>=', $request['req']['from']);
        }

        if (isset($request['req']['to']) && $request['req']['to'] != '') {
            $query->whereDate('created_at', '<=', $request['req']['to']);
        }

        if (isset($request['req']['deleted']) &&  $request['req']['deleted'] == 'only') {
            $query->onlyDeleted();
        }

        if (isset($request['req']['deleted']) &&  $request['req']['deleted'] == 'with') {
            $query->withDeleted();
        }

        if (isset($request['req']['status']) &&  $request['req']['status'] == '1') {
            $query->active();
        }

        if (isset($request['req']['type'])) {
            $query->where("type", $request['req']['type']);
        }


        if (isset($request['req']['status']) &&  $request['req']['status'] == '0') {
            $query->unactive();
        }

        return $query;
    }
}
