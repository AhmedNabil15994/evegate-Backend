<?php

namespace Modules\Setting\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\ResponseCache\Facades\ResponseCache;
use Modules\Setting\Http\Requests\Dashboard\SettingRequest;
use Modules\Setting\Repositories\Dashboard\SettingRepository as Setting;

class SettingController extends Controller
{
    function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function index()
    {
        return view('setting::dashboard.index');
    }

    public function update(SettingRequest $request)
    {
        $this->setting->set($request);

        ResponseCache::clear();

        return back()->with("success",__('apps::dashboard.messages.updated'));
    }

}
