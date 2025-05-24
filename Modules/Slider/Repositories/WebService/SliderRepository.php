<?php

namespace Modules\Slider\Repositories\WebService;

use Modules\Slider\Entities\Slider;
use Modules\Category\Entities\Category;

 class SliderRepository
 {
     public function __construct(Slider $slider)
     {
         $this->slider   = $slider;
     }

     public function getRandomPerRequest($request)
     {
         $sliders = $this->slider
                ->active()
                ;
         if ($request->position) {
             $sliders->where("position", $request->position);
         }

         if (is_numeric($request->category_id)) {
            $sliders->whereHas("categories", function ($base) use (&$request) {
                $base->where("categories.id", $request->category_id)
                                 ->when($request->withChildCategory, function ($childQuery) use (&$request) {
                                     $childIds =Category::active()->descendantsOf($request->category_id)
                                                         ->toFlatTree($request->category_id)->pluck("id")->toArray();
                                     if (count($childIds) > 0) {
                                         $childQuery->OrWhereIn("categories.id", $childIds);
                                     }
                                 })  ;
            });
        }
            
        if (is_array($request->category_id)) {
            $sliders->whereHas("categories", function ($base) use (&$request) {
                $allCategories = [];
                foreach ($request->category_id as $id) {
                    $childIds =Category::active()->descendantsOf($id)
                                                         ->toFlatTree($id)->pluck("id")->toArray();
                    array_push($childIds, (int)$id) ;
                    $allCategories = array_merge($allCategories, $childIds);
                }
                $base->whereIn("categories.id", $allCategories);
            });
        }


         return $sliders->unexpired()->started()->inRandomOrder()->take(6)->get();
     }
 }
