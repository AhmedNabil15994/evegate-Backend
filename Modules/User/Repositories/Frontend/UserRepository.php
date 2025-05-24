<?php

namespace Modules\User\Repositories\Frontend;

use Modules\QSale\Entities\Ads;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\User as Model;

class UserRepository
{
    public function __construct(Model $model)
    {
        $this->model      = $model;
    }

    public function userProfile($with = [])
    {
        $user = auth()->user();
        $user->load($with);
        return $user;
    }

    public function findMyAdsById($id, $with = [])
    {
        return Ads::authTenant()->where("id", $id)
            ->with($with)->firstOrFail();
    }

    public function favoritesCount()
    {
        $user =  auth()->user();
        if ($user) {
            return   $user->adsFavorites()
                ->allowShow()->count();
        }
        return 0;
    }

    public function usersCount()
    {
        return $this->model->user()->count();
    }

    public function update($request)
    {
        $user = auth()->user();
        $image = $user->image;
        if ($request->image) {
            deleteFileInStroage($user->image);
            $image = pathFileInStorage($request, "image", "users");
        }

        $data = [
            'name'          => $request['name'],
            'email'         => $request['email'],
            'mobile'        => $request['mobile'],
            'phone_code'    => $request['phone_code'],
            "image"         => $image,
        ];

        if ($request->password) {
            $data["password"] = bcrypt($request->password);
        }


        if (config("app.have_sms")) {
            if ($user->phone_code != $request['phone_code'] || $user->mobile != $request['mobile']) {
                $data = array_merge(
                    $data,
                    [
                        "is_verified" => false,
                    ]
                );
            }
        }



        DB::beginTransaction();
        try {
            $user->update($data);
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function createOrUpdateOffice(&$request)
    {
        $user = auth()->user();

        $old = $user->office;
        $image = "/uploads/default.png";
        if ($request->image) {
            if ($old->image) {
                deleteFileInStroage($old->image);
            }
            $image = pathFileInStorage($request, "image", "users/" . $user->id);
        }
        $data = array_merge($request->validated(), ["image" => $image]);


        DB::beginTransaction();
        try {
            $user->office()->updateOrCreate(["user_id" => $user->id], $data);
            if ($user->type != "office") {
                $user->update(["type" => "office"]);
            }
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function listAdsMe($request, $with = ["media"])
    {
        $sort = $this->mapSortBy($request->sorted_by);
        return \Modules\QSale\Entities\Ads::authTenant()
            ->with($with)
            ->orderBy($sort[0], $sort[1])
            ->paginate($request->page_count ?? config("app.page_count", 15));
    }


    public function listCurrentFavorite($request, $with = [])
    {
        $user = auth()->user();
        $sort = $this->mapSortBy($request->sorted_by);
        $models = $user->adsFavorites()
            ->allowShow()
            ->with($with)
            ->orderBy($sort[0], $sort[1])
            ->paginate($request->page_count ?? config("app.page_count", 15));
        return $models;
    }

    public function mapSortBy($key = null)
    {
        $map = [
            "latest" => ["id", "desc"],
            "oldest" => ["id", "asc"]
        ];
        if (!$key || ($key &&  !isset($map[$key]))) {
            return $map["latest"];
        }
        return $map[$key];
    }

    public function toggleFavorites($id)
    {
        $ads = Ads::find($id);

        if ($ads) {
            $user  = auth()->user();
            return $user->adsFavorites()->toggle($id);
        }
        return ["attached" => []];
    }
}
