<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GroupWord;
use Illuminate\Http\Request;

class GroupWordController extends Controller
{
    public function getGroupWord()
    {
        if (auth()->user()->premium > 0) {
            $group = GroupWord::whereHas('user', function ($query) {
                $query->where('id', auth()->user()->id);
            })->get();
        } else {
            $group = GroupWord::whereHas('user', function ($query) {
                $query->where('id', auth()->user()->id);
            })->get()->take(10);
        }
        foreach ($group as $key => $value) {
            $value->amount_word = $value->words->count();
        }

        return response()->json(['data' => $group], 200);
    }
    public function addGroupWord(Request $request)
    {
        $gw = new GroupWord();
        $gw->user_id = auth()->user()->id;
        $gw->name = ucfirst($request->name);
        $gw->save();
        $gw->amount_word = $gw->words->count();
        return response()->json(['data' => $gw], 200);
    }
    public function deleteGroupWord(Request $request)
    {
        $gw = GroupWord::where('user_id', auth()->user()->id)->where('id', $request->group_id);
        $gw->delete();
        return response()->json(['message' => 'success'], 200);
    }
}
