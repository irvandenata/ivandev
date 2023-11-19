<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $setting = Setting::where('config_group', 'payment')->where('config_key', $request->id)->first();
        $user = User::where('id', auth()->user()->id)->first();
        $user->premium += $setting->config_value;
        $user->save();

        return ResponseFormatter::success($user->premium, 'Success', 200);
    }
}
