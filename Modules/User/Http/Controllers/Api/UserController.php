<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\User\Entities\User;
use Modules\User\Enums\UserType;
use Illuminate\Support\Facades\Hash;
use Modules\User\Http\Requests\Api\RateRequest;
use Modules\User\Transformers\Api\UserResource;

use Modules\User\Http\Requests\Api\OfficeRequest;
use Modules\User\Http\Requests\Api\ResetPassword;
use Modules\User\Transformers\Api\AddressResource;
use Modules\User\Transformers\Api\UserRateResource;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\User\Transformers\Api\SelimUserResource;
use Modules\User\Http\Requests\Api\AddressStoreRequest;
use Modules\User\Http\Requests\Api\UpdateProfileRequest;
use Modules\User\Repositories\Api\UserRepository as Repo;
use Modules\User\Http\Requests\Api\UserSettingUpdateRequest;
use Modules\User\Transformers\Api\Notification\UserNotificationResource;
use Modules\User\Transformers\Api\Notification\UserNotificationCollection;

class UserController extends ApiController
{
    public $user;
    public function __construct(Repo $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users =  $this->user->getAll();


        return $this->responsePagnation(
            UserResource::collection($users)
        );
    }
    public function profile()
    {
        $user =  $this->user->userProfile(UserType::load(auth()->user()));

        return $this->response(new UserResource(
            $user->load([
                "company" => fn ($c) => $c->with(["categories", "state", "city"])
            ])
        ));
    }

    public function rate(RateRequest $request)
    {
        $this->user->rateUser($request);
        return $this->response([]);
    }

    public function getRate(request $request, $id)
    {
        $data =  $this->user->getUserRate($request, $id);
        $data["user"] = new SelimUserResource($data["user"]);
        if (isset($data["current_user_rate"])) {
            $data["current_user_rate"] = new UserRateResource($data["current_user_rate"]);
        } else {
            $data["current_user_rate"] = null;
        }
        return $this->response($data);
    }


    public function updateProfile(UpdateProfileRequest $request)
    {
        $this->user->update($request);

        $user =  $this->user->userProfile(UserType::load(auth()->user()));

        return $this->response(new UserResource(
            $user->load([
                "company" => fn ($c) => $c->with(["categories", "state", "city"])
            ])
        ));
    }

    public function getVerifiedCode(Request $request)
    {
        $user = User::where("phone_code", $request->phone_code)
            ->where("mobile", $request->mobile)->first();

        return $this->response(["code" => optional($user)->code_verified ?? ""]);
    }

    public function updateOrCreateOffice(OfficeRequest $request)
    {
        $user = $this->user->createOrUpdateOffice($request);
        $user->load(["office.country", "office.city", "office.state"]);
        return $this->response(new UserResource($user));
    }

    public function resetPassword(ResetPassword $request)
    {
        $user = auth()->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return $this->invalidData(["current_password" => __("user::api.users.validation.password.not_correct")]);
        }
        $this->user->updatePassword($user, $request);
        return $this->response([]);
    }

    public function updateSetting(UserSettingUpdateRequest $request)
    {
        $this->user->updateSetting($request);
        return $this->response([]);
    }


    public function testFcm(Request $request)
    {
    }



    public function notifications(Request $request)
    {
        $notifications = auth()->user()->notifications()->latest()->paginate($request->page_count ?? config("app.page_count", 15));
        return $this->responsePagnation(
            new UserNotificationCollection($notifications)
        );
    }

     public function deleteUserAccount(Request $request)
     {

         $user = $this->user->findById(auth()->id());
         if (!$user) {
             return $this->error(__('user::api.users.alerts.user_not_found'));
         }
         $prefix = 'toc_' . $user->id . '_';
         if (Str::startsWith($user->email, $prefix) || Str::startsWith($user->mobile, $prefix)) {
             return $this->error(__('user::api.users.alerts.user_deleted_before'));
         }

         $email = $prefix . $user->email;
         $mobile = $prefix . $user->mobile;

         $user->update([
             'email' => $email,
             'mobile' => $mobile,
         ]);
        // $user->fresh();
         auth()->user()->token()->revoke(); // logout user
         return $this->response([], __('user::api.users.alerts.user_deleted_successfully'));
     }
}
