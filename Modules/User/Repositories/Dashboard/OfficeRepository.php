<?php

namespace Modules\User\Repositories\Dashboard;

use DB;
use Hash;
use Modules\User\Entities\User;
use Modules\QSale\Entities\Package;
use Modules\User\Notifications\UserStatusChange;

class OfficeRepository
{
    public function __construct(User $user)
    {
        $this->user      = $user;
    }


    public function userCreatedStatistics()
    {
        $data["userDate"] = $this->user->officeUser()
            ->select(\DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date"))
            ->groupBy('date')
            ->pluck('date');

        $userCounter = $this->user->officeUser()
            ->select(\DB::raw("count(id) as countDate"))
            ->groupBy(\DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->get();



        $data["countDate"] = json_encode($userCounter->pluck("countDate")->toArray());

        return $data;
    }

    public function getStatistics()
    {
        $count  = $this->user->officeUser()->count();
        return ["count" => $count];
    }





    /*
    * Get All Normal Users Without Roles
    */
    public function getAllUsersActive($order = 'id', $sort = 'desc')
    {
        $users = $this->user->officeUser()->active()->orderBy($order, $sort)->select("id", "name", "type")->get();
        return $users;
    }

    /*
    * Find Object By ID
    */
    public function findById($id, $with = [])
    {
        $user = $this->user->officeUser()->withDeleted()->with($with)->findOrFail($id);
        return $user;
    }

    /*
    * Find Object By ID
    */
    public function findByEmail($email)
    {
        $user = $this->user->officeUser()->where('email', $email)->first();
        return $user;
    }






    /*
    * Generate Datatable
    */
    public function QueryTable($request)
    {
        $query = $this->user->officeUser()->withDeleted()->where('id', '!=', auth()->id())->where(function ($query) use ($request) {
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
