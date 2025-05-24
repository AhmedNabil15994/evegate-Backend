<?php

namespace Modules\Setting\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Apps\Http\Controllers\Api\ApiController;

class SettingController extends ApiController
{
    public function settings()
    {
        $locales       = setting('locales')        ? setting('locales') : ['ar',"en"];
        $settings = [
            'social_media'          => setting('social'),
            'contact_us'            => setting('contact_us'),
            'other'                 => setting('other'),
            "general_note"          => htmlView(setting("general_note", locale())),
            "countries_phone_code"  => supportedPhoneCodes(),
            "langues_support"       => supprtedLocalesApi($locales),
        ];

        return $this->response($settings);
    }

    public function countries()
    {
        $countries = supportedPhoneCodes();

        return $this->response($counties);
    }

    public function langues(Request $request)
    {
        return $this->response($this->responseLnagues());
    }

    public function responseLnagues()
    {
        $res = [];
        foreach (config('laravellocalization.supportedLocales') as $key => $value) {
            array_push(
                $res,
                [
                    "code"=>$key,
                    "name"=>$value["name"],
                    "native"=> $value["native"]
                    ]
            );
        }
        return $res;
    }
}
