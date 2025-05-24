<?php

use Modules\QSale\Entities\Ads;
use Modules\QSale\Entities\AppleTier;
use Modules\QSale\Entities\Coin;
use Modules\User\Entities\User;
use Modules\User\Enums\UserType;
use Spatie\Valuestore\Valuestore;
use Modules\Core\Packages\Setting\Setting;
use Modules\Social\Transformers\Api\OptionResource;
use Modules\Social\Transformers\Api\SocialResource;

// Get Setting Values
if (!function_exists('setting')) {
    function setting($key, $index = null)
    {
        $value = null;

        if (!is_null($index)) {
            if (Setting::get($key)) {
                $value = array_key_exists($index, Setting::get($key)) ? Setting::get($key)[$index] : null;
            }
        } else {
            $value = Setting::get($key);
        }


        return $value ? $value : null;
    }
}

if (!function_exists('supportedPhoneCodes')) {
    function supportedPhoneCodes()
    {
        return \Modules\Core\Packages\PhoneCodes\PhoneCodes::supportedPhoneCodes();
    }
}

if (!function_exists('getNumberOfCoinsForAdByUserType')) {
    function getNumberOfCoinsForAdByUserType($user = null)
    {   
        $user = $user ?? request()->user();
        return setting("other", ($user->type == UserType::COMPANY ? "company_coins_number_for_ad" : "default_price")) ?? 0;
    }
}

if (!function_exists('setCountryIDS')) {
    function setCountryIDS()
    {   
        foreach(Ads::where('user_type','user')->get() as $ad){
            $ad->country_id = User::find($ad->user_id)->country_id;
            $ad->save();
        }
    }
}

if (!function_exists('seedCoins')) {
    function seedCoins()
    {
        Coin::where('id','!=',null)->delete();
        $counter = 1;
        foreach(AppleTier::orderBy("price")->get() as $tier){
            Coin::create([
                "title" => [
                    'ar' => ($counter * 5) . ' عملات ',
                    'en' => ($counter * 5) . ' coins',
                ],
                "status" => 1,
                "coins_number" => $counter * 5,
                "apple_tier_id" => $tier->id,
            ]);
            $counter++;
        }
    }
}

if (!function_exists('handleIconAddition')) {
    function handleIconAddition($value)
    {
        $icons = \Modules\QSale\Enum\AddationType::$icons;
        return isset($icons[$value]) ?  $icons[$value] : "";
    }
}


if (!function_exists('supportedLocales')) {
    function supportedLocales($locales)
    {
        return array_intersect_key(config('core.available-locales'), array_flip($locales));
    }
}

if (!function_exists('supprtedLocalesApi')) {
    function supprtedLocalesApi($locales)
    {
        $data = [];
        foreach (supportedLocales($locales) as $key => $value) {
            unset($value["script"]);
            $value["code"] = $key;
            $data[] = $value;
        }
        return $data;
    }
}

//===========================

if (!function_exists('currentCountryCode')) {
    function currentCountryCode()
    {
        $ip = '';
        if (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR']; // This will contain the ip of the request
        }
        $data = array(
            'iso'      => 'EG',          // SA
            'name'     => 'Egypt', //"saudi arabia"
            'currency' => 'EGP',         //"SAR"
            'symbol'   => '£',          // "SR"
            'ratio'    => '17.3873',       //to USD  "3.750"
            'time_zone' => 'Africa/Cairo'   //'Asia/Riyadh'
        );
        $url = "http://www.geoplugin.net/json.gp?ip=" . $ip;
        // if(is_readable($url)){
        $geoplugin = @file_get_contents($url, true);
        if ($geoplugin === false) {
            return $data;
        } else {
            $dataArray = json_decode($geoplugin);
            if ($dataArray) {
                $data = array(
                    'iso'      => $dataArray->geoplugin_countryCode,    // EG
                    'name'     => $dataArray->geoplugin_countryName,    //"Egypt"
                    'currency' => $dataArray->geoplugin_currencyCode,   //"EGP"
                    'symbol'   => $dataArray->geoplugin_currencySymbol, // "£"
                    'ratio'    => $dataArray->geoplugin_currencyConverter, //to USD  "17.3873"
                    'time_zone' => $dataArray->geoplugin_timezone
                );
            }
        }
        // }
        return  $data;
    }
}

if (!function_exists('getSectionId')) {
    function getSectionId($key)
    {
    }
}

if (!function_exists('getSocialLink')) {
    function getSocialLink($socials, $id = null)
    {
        $social = $socials->where("social_id", $id)->first();
        if ($social) {
            return $social->link;
        }
        return  "";
    }
}

if (!function_exists('deleteFileInStroage')) {
    function deleteFileInStroage($base)
    {
        $path = str_replace("storage", "app/public", $base);

        \File::delete(storage_path($path));
    }
}

if (!function_exists('deleteDirecotoryInStroage')) {
    function deleteDirecotoryInStroage($base)
    {
        $path = storage_path("app/public/" . $base);

        \File::deleteDirectory($path);
    }
}

if (!function_exists('formatTotal')) {
    function formatTotal($number, $deciaml = 5)
    {
        return (float)(sprintf("%." . $deciaml . "f", $number));
    }
}

if (!function_exists('pathFileInStorage')) {
    function pathFileInStorage(&$request, $inputFile, $folderName)
    {
        // dd($folderName);
        $path = $request->file($inputFile)->store(
            $folderName,
            'public'
        );
        $path  = "storage/" . $path;
        return $path;
    }
}

if (!function_exists('pathFileInStorageForArray')) {
    function pathFileInStorageForArray(&$request, $inputFile, $key, $folderName)
    {
        $path = $request->file($inputFile)[$key]->store(
            $folderName,
            'public'
        );
        $path  = "storage/" . $path;
        return $path;
    }
}
if (!function_exists('getFileType')) {
    function getFileType($file)
    {
        $extension = strtolower($file->extension()) ?? "file";
        if (in_array($extension, ["png", "jpg", "jpep", "gif", "svg"])) {
            return "image";
        }
        return $extension;
    }
}


if (!function_exists('currency')) {
    function currency()
    {
        return "KWT";
    }
}


// Get Setting Values
if (!function_exists('metaReponse')) {
    function metaReponse($pagnation)
    {
        return [
            'total' => $pagnation->total(),
            'count' => $pagnation->count(),
            'per_page' => $pagnation->perPage(),
            'current_page' => $pagnation->currentPage(),
            'total_pages' => $pagnation->lastPage()
        ];
    }
}


// Get Setting Values
if (!function_exists('responseSocial')) {
    function responseSocial($socialOptions)
    {
        $socials =  $socialOptions->groupBy("social_id");
        $data = [];
        foreach ($socials as $key => $options) {
            if ($options->first()) {
                $social        = new SocialResource($options->first()->social);
                $socialOption  = [];
                foreach ($options as  $option) {
                    array_push($socialOption, new OptionResource($option->socialOption));
                }
                array_push($data, ["social" => $social, "options" => $socialOption]);
            }
        }

        return $data;
    }
}

if (!function_exists('handleSocialOption')) {
    function handleSocialOption($socialOptions)
    {
        $socials =  $socialOptions->groupBy("social_id");
        $data = [];
        foreach ($socials as $key => $options) {
            if ($options->first()) {
                $social        = $options->first()->social;
                $socialOption  = [];
                foreach ($options as  $option) {
                    array_push($socialOption, $option->socialOption);
                }
                array_push($data, ["social" => $social, "options" => $socialOption]);
            }
        }

        return $data;
    }
}

// Get Setting Values
if (!function_exists('generateRandomCode')) {
    function generateRandomCode($length = 5)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}


// Active Dashboard Menu
if (!function_exists('active_menu')) {
    function active_menu($routeNames)
    {
        $routeNames = (array) $routeNames;
        foreach ($routeNames as $routeName) {
            if (strpos(Route::currentRouteName(), $routeName) != 0) {
                return 'active';
            }
        }
        return  "";
    }
}

// Active Dashboard Menu
if (!function_exists('availabeLangueKey')) {
    function availabeLangueKey()
    {
        return  array_keys(config('laravellocalization.supportedLocales', ["ar" => 1, "en" => 2]));
    }
}


// GET THE CURRENT LOCALE
if (!function_exists('locale')) {
    function locale()
    {
        return app()->getLocale();
    }
}

// CHECK IF CURRENT LOCALE IS RTL
if (!function_exists('is_rtl')) {
    function is_rtl($locale = null)
    {
        $locale = ($locale == null) ? locale() : $locale;

        if (in_array($locale, config('rtl_locales'))) {
            return 'rtl';
        }

        return 'ltr';
    }
}


if (!function_exists('slugfy')) {
    /**
     * The Current dir
     *
     * @param string $locale
     */
    function slugfy($string, $separator = '-')
    {
        $url = trim($string);
        $url = strtolower($url);
        $url = preg_replace('|[^a-z-A-Z\p{Arabic}0-9 _]|iu', '', $url);
        $url = preg_replace('/\s+/', ' ', $url);
        $url = str_replace(' ', $separator, $url);

        return $url;
    }
}


if (!function_exists('path_without_domain')) {
    /**
     * Get Path Of File Without Domain URL
     *
     * @param string $locale
     */
    function path_without_domain($path)
    {
        $url = $path;
        $parts = explode("/", $url);
        array_shift($parts);
        array_shift($parts);
        array_shift($parts);
        $newurl = implode("/", $parts);

        return $newurl;
    }
}

if (!function_exists('int_to_array')) {
    /**
     * convert a comma separated string of numbers to an array
     *
     * @param string $integers
     */
    function int_to_array($integers)
    {
        if ($integers) {
            return array_map("intval", explode(",", $integers));
        }
        return  [];
    }
}
if (!function_exists('handleTime')) {
    /**
     * convert a comma separated string of numbers to an array
     *
     * @param string $integers
     */
    function handleTime($time, $format = false)
    {
        if ($format) {
            return (now()->minute("0")->hour($time))->format("h:i a");
        }
        if ($time <= 9) {
            return "0" . $time . ":00";
        }
        return $time . ":00";
    }
}

if (!function_exists('htmlView')) {
    /**
     * Access the OrderStatus helper.
     */
    function htmlView($content)
    {
        $bootstrap = url("js/bootstrap.min.js");
        return
            '<!DOCTYPE html>
           <html lang="en">
             <head>
               <meta charset="utf-8">
               <meta http-equiv="X-UA-Compatible" content="IE=edge">
               <meta name="viewport" content="width=device-width, initial-scale=1">
               <link href="css/bootstrap.min.css" rel="stylesheet">
               <!--[if lt IE 9]>
                 <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
                 <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
               <![endif]-->
             </head>
             <body>
               ' . $content . '
               <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
               <script src="' . $bootstrap . '"></script>
             </body>
           </html>';
    }
}
