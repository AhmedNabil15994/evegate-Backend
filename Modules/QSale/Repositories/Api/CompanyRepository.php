<?php

namespace Modules\QSale\Repositories\Api;

use File;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\DB;
use Modules\Qsale\Events\PaiedEvent;
use Modules\Category\Entities\Category;
use Modules\User\Entities\User as Model;
use Modules\Core\Packages\Payment\Contract\PaymentInterface;

class CompanyRepository
{
    public function __construct(Model $model)
    {
        $this->model   = $model;
    }

    public function getAllActive(&$request, $with = ["company"], $order = 'id', $sort = 'desc')
    {
        $query   =   $this->model
            ->companyType()
            ->allowShow()
            ->adsCount()
            ->searchFilter($request)
            ->withAvgRate();

        $this->baseFilterQuery($query, $request);

        return $query->with($with)
            ->orderBy($order, $sort)
            ->withCount(["ads"  => fn ($query) => $query->allowShow()])
            ->paginate($request->page_count ?? config("app.page_count", 15));
    }

    public function findById($id, $with = [])
    {
        return $this->model
            ->companyType()
            ->allowShow()
            ->where("id", $id)
            ->with($with)->firstOrFail();
    }

    public function getAdsForCompany(&$company)
    {
        $with = \Modules\QSale\Entities\Ads::getMainWith();
        return $company->ads()
            ->allowShow()
            ->with($with)
            ->latest()
            ->paginate($request->page_count ?? config("app.page_count", 15));
    }


    public function baseFilterQuery(&$query, $request)
    {
        if (is_numeric($request->category_id)) {
            $query->whereHas("company.categories", function ($base) use (&$request) {
                $base->where("categories.id", $request->category_id)
                    ->when($request->withChildCategory, function ($childQuery) use (&$request) {
                        $childIds = Category::active()->descendantsOf($request->category_id)
                            ->toFlatTree($request->category_id)->pluck("id")->toArray();
                        if (count($childIds) > 0) {
                            $childQuery->OrWhereIn("categories.id", $childIds);
                        }
                    })
                    ->when($request->withParentCategory, function ($parentQuery) use (&$request) {
                        $parentIds = Category::active()->ancestorsOf($request->category_id)
                            ->toFlatTree($request->category_id)->pluck("id")->toArray();

                        if (count($parentIds) > 0) {
                            $parentQuery->OrWhereIn("categories.id", $parentIds);
                        }
                    });
            });
        }

        if (is_array($request->category_id)) {
            $query->whereHas("company.categories", function ($base) use (&$request) {
                $allCategories = [];
                foreach ($request->category_id as $id) {
                    $childIds = [];
                    if ($request->withChildCategory) {
                        $childIds = Category::active()->descendantsOf($id)
                            ->toFlatTree($id)->pluck("id")->toArray();
                    }
                    if ($request->withParentCategory) {
                        $parentIds = Category::active()->ancestorsOf($id)
                            ->toFlatTree($id)->pluck("id")->toArray();
                        array_merge($childIds, $parentIds);
                    }
                    array_push($childIds, (int)$id);

                    $allCategories = array_merge($allCategories, $childIds);
                }
                $base->whereIn("categories.id", $allCategories);
            });
        }


        if ($request->search) {
            $query->where(function ($query) use (&$request) {
                $query->where("name", "like", "%" . $request->search . "%")
                    ->orWhereHas("company", function ($company) use (&$request) {
                        $company->where("title", "like", "%" . $request->search . "%");
                        $company->OrWhere("code", $request->search);
                    });
            });
        }


        if ($request->country_id) {
            $query->where("country_id", $request->country_id);
        }
    }
}
