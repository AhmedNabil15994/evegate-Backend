<?php

namespace Modules\User\Repositories\Dashboard;

use DB;
use Hash;
use Modules\User\Entities\User;
use Modules\User\Enums\UserType;
use Modules\QSale\Entities\Package;
use Modules\User\Notifications\UserStatusChange;
use Modules\User\Concerns\HandleUserSubscriptionAdmin;

class UserRepository
{
    use HandleUserSubscriptionAdmin;

    public function __construct(User $user)
    {
        $this->user      = $user;
    }


    public function userCreatedStatistics()
    {
        $data["userDate"] = $this->user
            ->user()
            ->select(\DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date"))
            ->groupBy('date')
            ->pluck('date');

        $userCounter = $this->user
            ->user()
            ->select(\DB::raw("count(id) as countDate"))
            ->groupBy(\DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->get();



        $data["countDate"] = json_encode($userCounter->pluck("countDate")->toArray());

        return $data;
    }

    public function getStatistics()
    {
        $count  = $this->user->user()->count();
        return ["count" => $count];
    }

    public function countUsers($order = 'id', $sort = 'desc')
    {
        $users = $this->user->user()->count();

        return $users;
    }

    /*
    * Get All Normal Users Without Roles
    */
    public function getAllUsers($order = 'id', $sort = 'desc')
    {
        $users = $this->user->user()->select("id,name")->orderBy($order, $sort)->get();
        return $users;
    }

    /*
    * Get All Normal Users Without Roles
    */
    public function getAllUsersActive($order = 'id', $sort = 'desc')
    {
        $users = $this->user->user()->active()->orderBy($order, $sort)->select("id", "name", "type")->get();
        return $users;
    }

    /*
    * Get All Normal Users Without Roles
    */
    public function getAllUsersSelect2($request, $order = 'id', $sort = 'desc')
    {
        $users = $this->user->active()->user();
        if ($request->search) {
            $users->where("name", "like", "%" . $request->search . "%");
        }
        return $users->orderBy($order, $sort)->select("id", "name as text", "type")->paginate(20);
    }


    /*
    * Find Object By ID
    */
    public function findById($id, $with = [])
    {
        $user = $this->user->withDeleted()->with($with)->findOrFail($id);
        return $user;
    }

    /*
    * Find Object By ID
    */
    public function findByEmail($email)
    {
        $user = $this->user->where('email', $email)->first();
        return $user;
    }


    /*
    * Create New Object & Insert to DB
    */
    public function create($request)
    {
        DB::beginTransaction();

        try {
            $image = $request['image'] ? pathFileInStorage($request, "image", "users")  :  "/uploads/users/user.png";

            $model = $this->user->create([
                'name'          => $request['name'],
                "phone_code"    => $request->phone_code,
                "type"          => UserType::USER,
                "is_active"     => $request->is_active == "on" ? 1 : 0,
                "is_verified"     => $request->is_active == "on" ? 1 : 0,
                'email'         => $request['email'],
                'mobile'        => $request['mobile'],
                'image'         => $image,
                'password'         => Hash::make($request->password),
                "country_id" => $request->country_id ?? config("customs.country_id")

            ]);

            if ($request->coin_blance && $request->coin_blance > 0) {
                $model->CreateUserCoinsBlance($request->coin_blance);
            }

            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    /*
    * Find Object By ID & Update to DB
    */
    public function update($request, $id)
    {
        DB::beginTransaction();

        $user = $this->findById($id, ["office", "currentSubscription"]);
        $restore = $request->restore ? $this->restoreSoftDelte($user) : null;

        try {
            $image =  $user->image;
            $copy  = $user->replicate();

            if ($request->image) {
                deleteFileInStroage($user->image);
                $image = pathFileInStorage($request, "image", "users");
            }



            if ($request['password'] == null) {
                $password = $user['password'];
            } else {
                $password  = Hash::make($request['password']);
            }

            $user->update([
                'name'          => $request['name'],
                "phone_code"    => $request->phone_code,
                "type"          => $request->type,
                "is_active"     => $request->is_active == "on" ? 1 : 0,
                "is_verified"   => $request->is_verified == "on" ? 1 : 0,
                'email'         => $request['email'],
                'mobile'        => $request['mobile'],
                'image'         => $image,
                'password'      => $password,
                "country_id" => $request->country_id ?? config("customs.country_id")
            ]);

            if ($request->coin_blance) {
                $user->CreateUserCoinsBlance($request->coin_blance);
            }

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


    /*
    * Find all Objects By IDs & Delete it from DB
    */
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

    /*
    * Generate Datatable
    */
    public function QueryTable($request)
    {
        $query = $this->user->withDeleted()->where('id', '!=', auth()->id())->user()->where(function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->input('search.value') . '%');
            $query->orWhere('name', 'like', '%' . $request->input('search.value') . '%');
            $query->orWhere('email', 'like', '%' . $request->input('search.value') . '%');
            $query->orWhere('mobile', 'like', '%' . $request->input('search.value') . '%');
        });

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    /*
    * Filteration for Datatable
    */
    public function filterDataTable($query, $request)
    {
        // Search Users by Created Dates
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
        if (isset($request['req']['status']) &&  $request['req']['status'] != '') {
            $query->where("is_active", $request['req']['status']);
        }

        if (isset($request['req']['type']) &&  $request['req']['type'] != '') {
            $query->where("type", $request['req']['type']);
        }




        return $query;
    }

    public function sendNotifcationStatusChange(&$user, $type)
    {
        if (env('FCM_SERVER')) {
            $user->notify(new UserStatusChange($type));
        }
    }
}
