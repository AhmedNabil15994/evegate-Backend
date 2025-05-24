<?php



use Illuminate\Http\Request;
use Modules\QSale\Entities\Ads;


use Illuminate\Routing\Controller;;
use Modules\QSale\Repositories\Frontend\FavoriteRepository as Repo;

class FavoriteController extends Controller
{
    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    
    public function toggle(Request $request, $id)
    {
        $user  = auth()->user();
        $ads   = $this->repo->getAds($id);
        if(!$ads) return $this->notFoundResponse();
        $toggle =  $this->repo->toggleToCurrentUser($user, $id);
        return $this->response(
            [
               "is_add" => in_array($id, $toggle["attached"])
           ]
        );
    }

   
}
