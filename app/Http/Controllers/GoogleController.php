<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {

        // jika user masih login lempar ke home
        if (Auth::check()) {
            return redirect('/admin/dashboard');
        }

        try {
            $oauthUser = Socialite::driver('google')->user();
            // dd($user);
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Try after some time');
        }
        $user = User::where('google_id', $oauthUser->id)->first();
        if ($user) {
            Auth::loginUsingId($user->id);
            return redirect('/detele-account');
        } else {
            $newUser = User::where('email', $oauthUser->email)->first();
            if ($newUser == null) {
                $newUser = User::create([
                    'name' => $oauthUser->name,
                    'email' => $oauthUser->email,
                    'username' => str_replace(' ', '-', strtolower($oauthUser->name)),
                    'google_id' => $oauthUser->id,
                    'password' => Hash::make($oauthUser->token),
                ]);
            }
            dd($newUser );
            Auth::login($newUser);
            return redirect('/delete-account');
        }
    }
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
            $user = User::where('google_id', $newUser->google_id)->first();
            Auth::login($user);
            return $user;
        }
        Auth::login($user);
        return $user;
    }
}
