<?php

namespace Modules\User\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller;

use Illuminate\Validation\ValidationException;
use Modules\User\Http\Requests\Frontend\OfficeRequest;
use Modules\User\Http\Requests\Frontend\UpdateProfileRequest;
use Modules\User\Repositories\Frontend\UserRepository as Repo;

class UserController extends Controller
{
    public function __construct(Repo $user)
    {
        $this->user = $user;
    }

   

    public function profile()
    {
        $userProfile =  $this->user->userProfile(["office", "currentSubscription.package"]);
       
        return view("user::frontend.profile", compact("userProfile"));
    }


    public function info()
    {
        $user =  $this->user->userProfile();
        return view("user::frontend.info", compact("user"));
    }

    public function verify()
    {
        $user =  auth()->user();
        return view("user::frontend.verified", compact("user"));
    }


    public function verified(Request $request)
    {
        $request->validate([
            "code"=>"required"
        ]);
        $user = auth()->user();

        
        if ($user->code_verified == $request->code) {
            $user->update(["code_verified"=>null, "is_verified"=>true]);
            return redirect()->route("frontend.user.my-profile")->withSuccess(__("user::frontend.verified.verified_success"));
        }
        throw ValidationException::withMessages(["code" => __('authentication::api.register.messages.code')]);
    }

    public function createOrUpdateOffice()
    {
        $user    =  $this->user->userProfile(["office"]);
        $office  = $user->office;
        return view("user::frontend.office", compact("user", "office"));
    }

    public function storeOrUpdateOffice(OfficeRequest $request)
    {
        $user  = $this->user->createOrUpdateOffice($request);
        return back()->with(['success' => __('user::frontend.office.update_info')]);
    }

    public function updateInfo(UpdateProfileRequest $request)
    {
        $user = $this->user->update($request);
        return back()->with(['success' => __('user::frontend.info.update_info')]);
    }


    public function myAds(Request $request)
    {
        $ads = $this->user->listAdsMe($request, ["media", "addationsModel", "category.ancestors","address"]);
        return view("user::frontend.myads", compact("ads"));
    }

    public function createAds(Request $request)
    {
        return view("user::frontend.create-ads");
    }


    public function editMyAd(Request $request, $id)
    {
        $ad = $this->user->findMyAdsById($id, ["office", "subscription", "user","addationsModel", "media", "addations", "attributes.attribute.options"]);

        // dd($ad->toArray());
        return view("user::frontend.edit-ads", compact("ad"));
    }

    

    public function myFavorites(Request $request)
    {
        $ads = $this->user->listCurrentFavorite($request, ["media", "category.ancestors","address"]);
     
        return view("user::frontend.my-favorites", compact("ads"));
    }


    public function toggleFavorite(Request $request, $id)
    {
        $toggle =  $this->user->toggleFavorites($id);
        return response()->json(
            [
               "is_add" => in_array($id, $toggle["attached"])
           ]
        );
    }
}
