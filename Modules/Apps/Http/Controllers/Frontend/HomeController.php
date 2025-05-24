<?php
namespace Modules\Apps\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Apps\Entities\Contact;
use Illuminate\Support\Facades\Notification;
use Modules\QSale\Repositories\Frontend\AdsRepository;
use Modules\Apps\Http\Requests\Frontend\ContactUsRequest;
use Modules\Apps\Notifications\Api\ContactUsNotification;

class HomeController extends Controller
{
    public function __construct(AdsRepository $adsRepository)
    {
        $this->adsRepository = $adsRepository;
    }
    public function index(Request $request)
    {
        $adsRecommend = $this->adsRepository->listAdsRecommend(["media", "addationsModel", "category.ancestors","address"], 8);

        // dd($adsRecommend->toArray());
        return view("apps::frontend.index", compact(
            "adsRecommend"
        ));
    }

    public function contactUs()
    {
        return view('apps::frontend.contact-us');
    }

    public function sendContactUs(ContactUsRequest $request)
    {
        $contact = Contact::create($request->validated());
        Notification::route('mail', setting('contact_us', 'email'))
                    ->notify((new ContactUsNotification($request))->locale(locale()));

        return redirect()->back()->with(['success' => __('apps::frontend.contact_us.alerts.send_message')]);
    }
}
