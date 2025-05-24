<?php

namespace Modules\Setting\Repositories\Dashboard;

use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Modules\Core\Packages\Setting\Setting;

class SettingRepository
{
    public function __construct(DotenvEditor $editor)
    {
        $this->editor = $editor;
    }

    public function set($request)
    {

        $this->saveSettings($request->except('_token', '_method'));

        return true;
    }

    public function saveSettings($request)
    {

        foreach ($request as $key => $value) {
            if ($key == 'translate') {
                static::setTranslatableSettings($value);
            }

            if ($key == 'images') {
                static::setImagesPath($value, $request);
            }

            if ($key == 'env') {
                static::setEnv($value);
            }

            Setting::put($key, $value);
        }

        if (!isset($request["protected_cat"])) {
            Setting::put("protected_cat", []);
        }
    }

    public static function setTranslatableSettings($settings = [])
    {
        foreach ($settings as $key => $value) {
            Setting::put($key, [
                locale()  => $value,
            ]);
        }
    }

    public static function setImagesPath($settings = [])
    {
        foreach ($settings as $key => $value) {
            $image  = setting($key);
            if ($value) {
                deleteFileInStroage(setting($key));
                $request = request();
                $image =   pathFileInStorageForArray($request, "images", $key, "settings");

                if ($key == "logo") {
                    \File::copy(storage_path("app/" . str_replace("storage", "public", $image)), public_path("uploads/default.png"));
                }
            }

            Setting::put($key, $image);
        }
    }

    public static function setEnv($settings = [])
    {
        foreach ($settings as $key => $value) {
            $file = DotenvEditor::setKey($key, $value, '', false);

            Setting::put($key, $value);
        }

        $file = DotenvEditor::save();
        //        dd($settings);
    }
}
