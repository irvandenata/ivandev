<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OwnWord;
use App\Models\Word;
use App\Providers\UserActivity;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class OwnedWordController extends Controller
{
    public function getOwnedWord($id)
    {
        if (auth()->user()->premium > 0) {
            $word = OwnWord::where('group_id', $id)->whereHas('user', function ($q) {
                $q->where('id', auth()->user()->id);
            })->latest()->with('group')->orderBy('created_at','desc')->get();
        } else {
            $word = OwnWord::where('group_id', $id)->whereHas('user', function ($q) {
                $q->where('id', auth()->user()->id);
            })->latest()->with('group')->orderBy('created_at','desc')->take(10)->get();
        }
        return response()->json(['data' => $word], 200);
    }

    public function addOwnedWord(Request $request)
    {
        try {
            $tr = new GoogleTranslate('id');
            $tr->setSource('en');
            $tr->setTarget('id');
            $data = $tr->translate($request->word);
            $word = new OwnWord();
            if (ucfirst($data) != ucfirst($request->word)) {
                $word->word = ucfirst($data);
                $word->mean = ucfirst($request->word);
            } else {
                $word->word = ucfirst($request->word);
                $word->mean = "0";
            }
            $word->user_id = auth()->user()->id;
            $word->group_id = $request->group_id;
            $word->save();
            return response()->json(['data' => $word], 200);
        } catch (\Exeption $th) {
            return response()->json(['message' => $th], 500);
        }

    }
    public function removeOwnedWord(Request $request)
    {
        $word = OwnWord::where('id', $request->word_id);
        if(!$word){
            return response()->json(['message' => 'word not found'], 404);
        }
        $word->delete();
        return response()->json(['message' => 'success'], 200);
    }

    public function test ($name){
        event(new UserActivity(1, $name,request()->ip()));
        return response()->json(['message' => 'success'], 200);
    }
}
