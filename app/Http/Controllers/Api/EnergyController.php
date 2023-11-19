<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Setting;
use App\Models\User;
use App\Providers\UserActivity;
use Illuminate\Http\Request;

class EnergyController extends Controller
{
    public function getEnergy(Request $request)
    {
        return response()->json(['data' => ['energy' => auth()->user()->energy]], 200);
    }

    public function addEnergy(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $energy = Setting::where('config_key', 'add_energy')->first()->config_value;
        $limit = Setting::where('config_key', 'energy_limit')->first()->config_value;
        $user->energy = $user->energy + $energy;
        if ($user->energy > $limit) {
            $user->energy = $limit;
        }
        $user->save();
        return response()->json(['data' => ['energy' => $user->energy]], 200);
    }

    public function reduceEnergy(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        if ($request->energy != null) {
            $user->energy -= $request->energy;
        } else {
            $user->energy -= 1;
        }
        if ($user->energy < 0) {
            $user->energy = 0;
        }
        $user->save();
        $user->image_url = $user->photo_url == null ? url('profil.png') : $user->photo_url;

        $token = $user->createToken('auth_token')->plainTextToken;
        $user = UserResource::make($user);
        return response()->json(['user' => $user, 'token' => $token], 200);
    }

    public function updateEnergy (){
        User::query()->update(['energy' => 5]);
        return response()->json(['data' => ['energy' => 5]], 200);
    }

    public function refillEnergy (){
      $user = User::where('id', auth()->user()->id)->first();
      $energy =3;
      $limit =5;
      $user->energy = $user->energy + $energy;
      if ($user->energy > $limit) {
          $user->energy = $limit;
      }
      $user->save();
      event(new UserActivity(auth()->user()->id, 'Show Ads Reward',request()->ip()));
      $user->image_url = $user->photo_url == null ? url('profil.png') : $user->photo_url;
        $token = $user->createToken('auth_token')->plainTextToken;
        $user = UserResource::make($user);
        return response()->json(['user' => $user, 'token' => $token], 200);
    }
}
