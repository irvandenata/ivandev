<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdditionalInfo;
use App\Models\Article;
use App\Models\User;

class ApiController extends Controller
{
    public function getHeader()
    {
        $header = User::first();
        return response()->json(['status' => 'success', 'data' => $header]);
    }

    public function getTechStack()
    {

        $techStack = AdditionalInfo::whereHas('type', function ($query) {
            $query->where('name', 'Tech Stack');
        })->get();
        return response()->json(['status' => 'success', 'data' => $techStack]);
    }

    public function getWorkExp()
    {
        $workExp = AdditionalInfo::whereHas('type', function ($query) {
            $query->where('name', 'Work Experiences');
        })->orderBy('end_date', 'desc')->get();
        return response()->json(['status' => 'success', 'data' => $workExp]);
    }

    public function getProjects()
    {
        $projects = Article::whereHas('category', function ($query) {
            $query->where('name', 'Project');
        });
        if (request()->search) {
            $projects = $projects->where('title', 'like', '%' . request()->search . '%');
        }
       if(request()->perPage){
            $projects = $projects->orderBy('created_at', 'desc')->paginate(request()->perPage);
         }else{
            $projects = $projects->orderBy('created_at', 'desc')->with('category')->paginate(8);
         }
        return response()->json(['status' => 'success', 'data' => $projects]);
    }

    public function getArticles()
    {

        $articles = Article::whereHas('category', function ($query) {
            $query->where('name', '!=','Project');
        });
        if (request()->search) {
            $articles = $articles->where('title', 'like', '%' . request()->search . '%');
        }
        if(request()->perPage){
            $perPage = request()->perPage;
        }else{
            $perPage = 8;
        }
        $articles = $articles->orderBy('created_at', 'desc')
        ->with('category')
        ->paginate($perPage);
        return response()->json(['status' => 'success', 'data' => $articles]);
    }
    public function getArticle($slug)
    {
        $article = Article::where('slug', $slug)->with('category')->first();
        return response()->json(['status' => 'success', 'data' => $article]);
    }
}
