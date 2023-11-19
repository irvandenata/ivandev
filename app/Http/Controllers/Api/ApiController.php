<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ApiController extends Controller
{
    public function mobileLogin(Request $request)
    {
        $user = User::where('google_id', $request->id)->first() ?? null;
        if ($user == null) {
            $newUser = User::where('email', $request->email)->first();
            if ($newUser == null) {
                $newUser = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'username' => str_replace(' ', '-', strtolower($request->name)),
                    'google_id' => $request->id,
                    'password' => Hash::make($request->token),
                ]);
            }
            Auth::login($newUser);
            return $newUser;
        }
        Auth::login($user);
        $user = User::where('id', $user->id)->first()->with('languages');
        dd($user);
        return $user;
    }

    public function test()
    {

        $tr = new GoogleTranslate('id');
        $data = $tr->translate('kamu siapa!');

        return $data == 'when!';
    }
}
