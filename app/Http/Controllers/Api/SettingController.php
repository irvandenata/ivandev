<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingController extends Controller
{
    public function getAllSetting()
    {
        $setting = Setting::all();
        return ResponseFormatter::success($setting, 'Success', 200);
    }

    public function getVersion(){
        $version = Setting::where('config_key','version')->first()->config_value;
        $response = explode('.', $version);
        return response()->json(['version' => $response]);
    }
}
