<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GroupWord;
use App\Models\Language;
use App\Models\LanguageUser;
use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\TextUI\XmlConfiguration\Group;

class LanguageController extends Controller
{
    public function getLanguages()
    {
        $lang = Language::where('status',1)->get()->sortBy('name');
        return response()->json( $lang, 200);
    }

    public function getOwnedLanguage(Request $request)
    {
        $lang = Language::whereHas('users', function ($query) {
            $query->where('users.id', auth()->user()->id);
        })->get()->sortBy('name');
        return response()->json( $lang, 200);
    }

    public function getNotOwnedLanguage(Request $request)
    {
        $lang = Language::whereDoesntHave('users', function ($query) {
            $query->where('users.id', auth()->user()->id);
        })->get();
        return response()->json( $lang, 200);
    }


    public function setLanguage(Request $request)
    {
        $lang = LanguageUser::where('user_id', auth()->user()->id)->where('language_id', $request->language_id)->first() ?? null;
        if ($lang == null) {
            $lang = new LanguageUser();
            $lang->user_id = auth()->user()->id;
            $lang->language_id = $request->language_id;
            $lang->save();
        }
        return response()->json(["data"=>auth()->user()->languages], 200);
    }


    public function removeLanguage(Request $request){
        $user = User::where('id',auth()->user()->id)->first();
        $user->languages()->detach($request->language_id);
    return response()->json(["message"=>'success'],200);
    }
}
