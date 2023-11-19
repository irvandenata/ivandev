<?php

namespace App\Helpers;

use App\Models\ActivityCategory;
use App\Models\TestResult;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Image;
use Str;
/**
 * Format response.
 */
class GlobalFunction
{
    public static function userForApi(User $user)
    {

        $result = TestResult::where('user_id', $user->id)->with('language', 'group')->latest()->first();
        if ($result != null) {
            $result->group->amount_word = $result->group->words->count();
        }
        $user->result = $result;
        foreach ($user->groupWords as $value) {
            $value->amount_word = $value->words->count();
        }
        $user->result = $result;
        return $user;
    }


    public static function storeSingleImage ($image, $path)
   {
    try {
        $name_picture = Str::random(6) . '.webp';
        $picture = Image::make($image)->encode('webp', 90);
        $pathImg = "$path/$name_picture";
        Storage::put("public/" . $pathImg, $picture);
        return "$pathImg";
    } catch (\Throwable $th) {
        throw $th;
    }


   }
   public static function updateSingleImage ($image, $path, $oldImage)
   {
        $name_picture = Str::random(6) . '.webp';
        $picture = Image::make($image)->encode('webp', 90);

        $pathImg = "$path/$name_picture";
        Storage::put("public/" . $pathImg, $picture);
        if(Storage::exists("public/" . $oldImage)){
            Storage::delete("public/" . $oldImage);
        }

       return "$pathImg";
   }

   public static function deleteSingleImage ($image)
   {
        if(Storage::exists("public/" . $image)){
            Storage::delete("public/" . $image);
        }
   }

   public static function makeSlug($model,$string){
        $string = str_replace(' ', '-', $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        $slug = strtolower(preg_replace('/-+/', '-', $string));
        $model = $model->where('slug', $slug)->first();
        if($model){
            $slug = $slug . '-' . rand(1, 100);
        }
        return $slug;
   }


}
