<?php

namespace Modules\QSale\Concerns;

use Modules\QSale\Enum\AdsType;
use Modules\QSale\Enum\AdsStatus;
use Illuminate\Support\Facades\DB;
use Modules\Category\Entities\Category;

/**
 * Ads function  and scope
 */
trait AdsTrait
{
    public function checkIsPublish()
    {
        $now = now()->format("Y-m-d");
        $inDate = ($now >= date($this->start_at) && $now <= date($this->end_at));
        return in_array($this->status, [AdsStatus::PUBLIUSH, AdsStatus::CONFIRM]) && $inDate;
    }

    public function checkIsNotExpired()
    {
        $now = now()->format("Y-m-d");
        return $now > $this->end_at;
    }

    public function scopeAuthTenant($query)
    {
        $query->where("user_id", auth()->id());
    }

    public function removeAddation($addation)
    {
        $this->update([
            "addation_total" => $this->addation_total - $addation->price,
            "total"          => $this->total - $addation->price
        ]);
        $addation->delete();
    }

    public function handleUserSubscription(&$user)
    {
        if ($this->type ==  AdsType::FREE) {
            $user->increment("number_of_free");
            return $user;
        }

        if ($this->type == AdsType::SUBSCRIPTION && $user->currentSubscription) {
            $user->currentSubscription->increment("current_use");
            return $user;
        }
    }

    public function handleUndoUserSubscription(&$user)
    {
        if ($this->type ==  AdsType::FREE) {
            $user->decrement("number_of_free");
            return $user;
        }

        if ($this->type == AdsType::SUBSCRIPTION && $user->currentSubscription) {
            if ($user->currentSubscription->current_use != 0) {
                $user->currentSubscription->decrement("current_use");
            }
            return $user;
        }
    }

    public function confirm()
    {
        $now = now();
        $this->update([
            "is_paid"   => true,
            "status"    => AdsStatus::PUBLIUSH,
            "published_at" => now(),
            "start_at"  => now()->format("Y-m-d"),
            "end_at"    => $now->copy()->addDays($this->duration)->format("Y-m-d"),
        ]);
    }

    public function scopeLoadUserWithAvg($query, $request)
    {
        if ($request->rate_info) {
            $query->with(["user" => function ($q) {
                $q->withAvgRate();
            }]);
        }

        return $query;
    }

    public function scopeAllowShow($query)
    {
        return $query
            ->where("ads.status", AdsStatus::PUBLIUSH)
            ->where("ads.is_paid", true)
            ->whereHas("user", fn ($user) => $user->where("users.is_active", 1))
            ->where('ads.start_at', '<=', date('Y-m-d'))
            ->where('ads.end_at', '>=', date('Y-m-d'));
    }


    public function scopeAllowShowWithOutActive($query)
    {
        $query
            ->where("ads.status", AdsStatus::PUBLIUSH)
            ->where("ads.is_paid", true)
            ->where('ads.start_at', '<=', date('Y-m-d'))
            ->where('ads.end_at', '>=', date('Y-m-d'));
    }
    public function scopeSearchBase($query, $request)
    {
        $query->where(function ($query) use (&$request) {
            //  for key word search
            $query->when($request->search, function ($search) use (&$request) {

                // make it isolation
                $search->where(function ($search) use (&$request) {
                    $search->where("title", 'like', '%' . $request->input('search') . '%')
                        ->orWhere("description", 'like', '%' . $request->input('search') . '%')
                        ->orWhereHas("category.translations", function ($category) use (&$request) {
                            $category
                                ->where('title', 'like', '%' . $request->input('search') . '%');
                        });
                });
            });

            $query->when($request->company_id, function ($base) use (&$request) {
                $base->whereHas("user.company", fn ($q) => $q->where("companies.id", $request->company_id));
            });

            // for user id
            $query->when($request->user_id, function ($base) use (&$request) {
                $base->where("user_id", $request->user_id);
            });

            // // for country id
            // $query->when($request->country_id, function ($base) use (&$request) {
            //     $base->where("country_id", $request->country_id);
            // });

            // // for city id
            // $query->when($request->city_id, function ($base) use (&$request) {
            //     $base->where("city_id", $request->city_id);
            // });

            // // for state id
            // $query->when($request->state_id, function ($base) use (&$request) {
            //     $base->where("state_id", $request->state_id);
            // });

            // for subscription id
            $query->when($request->subscription_id, function ($base) use (&$request) {
                $base->where("subscription_id", $request->subscription_id);
            });

            // for addations id
            $query->when($request->addation_id, function ($base) use (&$request) {
                $base->whereHas("addations", fn ($addation) => $addation
                    ->where("addation_id", $request->addation_id));
            });

            if ($request->user_type) {
                $query->where("user_type", $request->user_type);
            }
        });
    }

    public function scopeCategoryFilter($query, $request)
    {
        if (is_numeric($request->category_id)) {
            $query->where(function ($base) use (&$request) {
                $base->where("category_id", $request->category_id)
                    ->when($request->withChildCategory, function ($childQuery) use (&$request) {
                        $childIds = Category::active()->descendantsOf($request->category_id)
                            ->toFlatTree($request->category_id)->pluck("id")->toArray();
                        if (count($childIds) > 0) {
                            $childQuery->OrWhereIn("category_id", $childIds);
                        }
                    });
            });
        }
        if (is_array($request->category_id)) {
            $query->where(function ($base) use (&$request) {
                $allCategories = [];
                foreach ($request->category_id as $id) {
                    $childIds = Category::active()->descendantsOf($id)
                        ->toFlatTree($id)->pluck("id")->toArray();
                    array_push($childIds, (int)$id);
                    $allCategories = array_merge($allCategories, $childIds);
                }
                $base->whereIn("category_id", $allCategories);
            });
        }
        return $query;
    }

    public function scopeCategorySlugFilter($query, $request)
    {
        if ($request->category) {
            $query->where(function ($base) use (&$request) {
                $base->whereHas("category.translations", function ($category) use (&$request) {
                    $category->where("slug", $request->category);
                });
            });
        }
        return $query;
    }

    public function scopeAttributeFilter($query, $request)
    {
        if (is_array($request->attribute)) {
            // collapse the search attribute
            $query->where(function ($query) use (&$request) {
                foreach ($request->attribute as $attribute) {
                    $query->whereHas("attributes", function ($base) use (&$attribute) {
                        // $attribute = $request->attribute;

                        $base->when(isset($attribute["attribute_id"]), fn ($query) => $query->where("attribute_id", $attribute["attribute_id"]))
                            ->when(isset($attribute["options_id"]) && is_array($attribute["options_id"]), fn ($query) => $query->whereIn("option_id", $attribute["options_id"]))
                            ->when(isset($attribute["options_id"]) && is_numeric($attribute["options_id"]), fn ($query) => $query->where("option_id", $attribute["options_id"]))
                            ->when(isset($attribute["value"]) && $attribute["value"] && is_numeric($attribute["value"]), fn ($query) => $query->where("ads_attributes.value", '=', $attribute["value"]))
                            ->when(isset($attribute["value"]) && $attribute["value"] && !is_numeric($attribute["value"]), fn ($query) => $query->where("value", 'like', '%' . $attribute["value"] . '%'));

                        if (isset($attribute["min"]) &&  isset($attribute["max"])) {
                            $base->whereBetween("ads_attributes.value", [(int)$attribute["min"], (int) $attribute["max"]]);
                        }
                    });
                }
            });
        }
        return $query;
    }

    public function scopeAddressFilter($query, $request)
    {
        if($request->country_id && !$request->company_id){
            $query->where("country_id", $request->country_id);
        }
        
        return $query;
    }

    public function scopePriceFilter($query, $request)
    {
        if (is_array($request->price)) {
            $query->where(function ($base) use (&$request) {
                $price = $request->price;
                $base->when(
                    isset($price["min"]),
                    function ($ads) use (&$price) {
                        $ads->whereRaw("ads.price >= ?", $price["min"]);
                    }
                )
                    ->when(
                        isset($price["max"]),
                        function ($ads) use (&$price) {
                            $ads->whereRaw("ads.price <= ? ", $price["max"]);
                        }
                    );
            });

            if ($request->input("price.min") == 0) {
                $query->orWhereNull("ads.price");
            }
        }

        return $query;
    }

    public function scopeIsFavourit($query, $user_id)
    {
        return $query->withCount([
            "userFavorites as is_favorite" => function ($query) use ($user_id) {
                $query->select(\DB::raw("count(favorites.ads_id) > 0 "))
                    ->whereRaw("users.id = ?", $user_id);
            }
        ]);
    }


    public function scopeTypeAddationFilter($query, $request)
    {
        if ($request->type_addation) {
            $query->whereHas("addationsModel", function ($addation) use (&$request) {
                $addation->where("addations.type", $request->type_addation);
            });
        }
        if ($request->without_addation) {
            $query->doesntHave("addationsModel");
        }

        return $query;
    }

    public function scopeSortFilter($query, $request)
    {
        if ($request->sort_type_addation) {
            $query->sortBasedType($request->sort_type_addation);
        }
    }

    public function scopeSortBasedType($query, $type, $sort = "DESC")
    {
        $query->withCount(["addationsModel as addations_sort" => function ($addation) use ($type) {
            $addation->select(DB::raw("count(addations.id) > 0 "))
                ->where("addations.type", $type);
        }]);
        $query->orderBy("addations_sort", $sort);
    }

    public function scopeWithIsType($query, $name = "is_feature", $type = "1")
    {
        $query->withCount([
            "addationsModel as $name" => fn ($addation) =>
            $addation->select(DB::raw("count(addations.id) > 0 "))
                ->where("addations.type", $type)
        ]);
    }

    public function scopeFilterAdType($query, $request)
    {
        if ($request->ad_type_id) {
            $op = is_array($request->ad_type_id) ? "whereIn" : "where";
            $query->whereHas("adTypes", fn ($q) => $q->$op("ad_types.id", $request->ad_type_id));
        }
    }


    public function checkIsType($type)
    {
        return $this->addationsModel->firstWhere("type", "=", $type);
    }
}
