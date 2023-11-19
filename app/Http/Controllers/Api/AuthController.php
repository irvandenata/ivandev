<?php

namespace App\Http\Controllers\Api;

use App\Helpers\GlobalFunction;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\GroupWord;
use App\Models\OwnWord;
use App\Models\TestResult;
use App\Models\User;
use App\Providers\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // return "gagal";
        if($request->google_id != null){
            $user = User::where('email', $request->email)->orWhere('google_id', $request->google_id)->first() ?? null;
        }else{
            $user = User::where('email', $request->email)->first();
        }

        if ($user == null) {
            $user = new User();
            if ($request->name != "null") {
                $user->name = $request->name;
                $user->username = str_replace(' ', '-', strtolower($request->name));
            } else {
                $user->name = explode('@', $request->email)[0];
                $user->username = explode('@', $request->email)[0];
            }

            $user->email = $request->email;
            if($request->photo_url != null && $user->photo_url != "null" && $user->photo_url != 'null'){
                $user->photo_url = $request->photo_url;
            }
            $user->photo_url = $request->photo_url;
            $user->google_id = $request->google_id;
            $user->password = Hash::make(str_replace(' ', '-', strtolower($request->name)));
            $user->save();
            event(new UserActivity($user->id, 'New User',request()->ip()));
            $user = User::where('email', $user->email)->orWhere('google_id', $user->google_id)->first() ?? null;
        }else{
            if($request->photo_url != null && $user->photo_url != "null" && $user->photo_url != 'null'){
                $user->photo_url = $request->photo_url;
                $user->save();
            }
        }
        Auth::login($user);
        $user = User::where('id', auth()->user()->id)->first();
        $user->image_url = $user->photo_url == null ? url('profil.png') : $user->photo_url;

        $token = $user->createToken('auth_token')->plainTextToken;
        $user = UserResource::make($user);
        return response()->json(['user' => $user, 'token' => $token], 200);
    }

    public function logout(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $user->tokens()->delete();
        return response()->json(['message' => 'success'], 200);
    }

    public function authCheck()
    {
        $user = User::where('id', auth()->user()->id)->first();
        $user->image_url = $user->photo_url == null ? url('profil.png') : $user->photo_url;

        $token = $user->createToken('auth_token')->plainTextToken;
        $user = UserResource::make($user);
        return response()->json(['user' => $user, 'token' => $token], 200);
    }

    public function uploadImage(Request $request)
    {
        try {

            if($request->file('image')){

                $file = $request->file('image');
                    $path = GlobalFunction::storeSingleImage($file, 'users');
                    $user = User::where('id', auth()->user()->id)->first();
                    $user->photo_url = $path;
                    $user->save();
                $user = UserResource::make($user);
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json(['user' => $user, 'token' => $token], 200);
            } else {
                return response()->json(['message' => 'failed'], 400);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th], 500);
        }



    }
}
