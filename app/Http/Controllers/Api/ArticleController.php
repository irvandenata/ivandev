<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\User;
use App\Providers\UserActivity;
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function getArticleCategories()
    {
        try {
            $categories = ArticleCategory::where('status', 1)->get()->sortBy('name');
            return ResponseFormatter::success($categories, 'Success', 200);
        } catch (\Exception $e) {
            return ResponseFormatter::error('', $e->getMessage(), 500);
        }
    }

    public function getArticlesByCategory($slug)
    {
        try {

            $articles = Article::whereHas('category', function ($query) use ($slug) {
                $query->where('status', 1)->where('slug', $slug);
            })->where('status', 1)->get()->sortBy('created_at');

            foreach ($articles as $article) {
                $article->category_name = $article->category->name;
                $article->date = Carbon::parse($article->created_at)->format('d F Y');
            }
            return ResponseFormatter::success($articles, 'Success', 200);
        } catch (\Exception $e) {
            return ResponseFormatter::error('', $e->getMessage(), 500);
        }
    }

    public function getArticles()
    {
        try {
            $articles = Article::query();
            $query = request()->query();
            if(isset($query['category']) && $query['category'] != "''" && $query['category'] != '""'){
                $category = $query['category'];
                $articles = $articles->whereHas('category', function ($query) use ($category) {
                    $query->where('status', 1)->where('slug', $category);
                });
            }
            if (isset($query['search']) && $query['search'] != "''" && $query['search'] != '""') {
                $articles->where('title', 'LIKE', '%' . $query['search'] . '%')->orWhere('body', 'LIKE', '%' . $query['search'] . '%');
            }
            if (isset($query['orderby'])&& $query['orderby'] != "''" && $query['orderby'] != '""') {
                if($query['orderby'] == 'likes'){
                    $articles->withCount('likedArticle')->orderBy('liked_article_count', 'desc');
                }else{
                    $articles->orderBy($query['orderby'], 'desc');
                }
            }
            if (isset($query['saved']) && $query['saved'] == 1) {
                $articles->whereHas('savedArticle', function ($query) {
                    $query->where('user_id', auth()->user()->id)->where('status', 1);
                });
            }

            $articles = $articles->where('status', 1)->orderBy('created_at', 'desc');
            $articles = $articles->paginate(10); //pass variable in closure by using use
            $articles->map(function($item) {
                $item->category_name = $item->category->name;
                $item->likes = $item->likedArticle()->where('status', 1)->count();
                $item->date = Carbon::parse($item->created_at)->format('d F Y');
                return $item;
            });
            return ResponseFormatter::success($articles, 'Success', 200,'paginate');
        } catch (\Exception $e) {
            return ResponseFormatter::error('', $e->getMessage(), 500);
        }
    }

    public function showArticle($slug)
    {
        try {
            $article = Article::where('slug', $slug)->get();
            if ($article == null) {
                return ResponseFormatter::error('', 'Article not found', 404);
            }
            foreach ($article as $item) {
                $item->category_name = $item->category->name;
                $item->date = Carbon::parse($item->created_at)->format('d F Y');
                $item->liked = $item->likedArticle()->where('user_id',auth()->user()->id)->first()? $item->likedArticle()->where('user_id',auth()->user()->id)->first()->status : 0;
                $item->saved = $item->savedArticle()->where('user_id',auth()->user()->id)->first()? $item->savedArticle()->where('user_id',auth()->user()->id)->first()->status : 0;
                $item->likes = $item->likedArticle()->where('status', 1)->count();
            }
            event(new UserActivity(auth()->user()->id, 'Show Article', request()->ip()));
            return ResponseFormatter::success($article, 'Success', 'single');
        } catch (\Exception $e) {
            return ResponseFormatter::error('', $e->getMessage(), 500);
        }
    }

    public function newArticles()
    {
        try {
            $query = request()->query();
            $articles = Article::where('status', 1)->orderBy('created_at', 'desc')->take(5)->get();
            foreach ($articles as $article) {
                $article->category_name = $article->category->name;
                $article->date = Carbon::parse($article->created_at)->format('d F Y');
                $article->likes = $article->likedArticle()->where('status', 1)->count();
            }
            return ResponseFormatter::success($articles, 'Success', 200);
        } catch (\Exception $e) {
            return ResponseFormatter::error('', $e->getMessage(), 500);
        }
    }

    public function saveArticle($slug){
        try {
            $article = Article::where('slug', $slug)->first();
            if ($article == null) {
                return ResponseFormatter::error('', 'Article not found', 404);
            }
            $user = User::find(auth()->user()->id);
            $user->saveArticle($article->id);
            $article = Article::where('slug', $slug)->first();

            $article->saved = $article->savedArticle()->where('user_id',auth()->user()->id)->first()->status;

            event(new UserActivity(auth()->user()->id, 'Save Article', request()->ip()));
            return ResponseFormatter::success(['Success'], 200,'single');

        } catch (\Exception $e) {
            return ResponseFormatter::error('', $e->getMessage(), 500);
        }
    }

    public function likeArticle($slug){
        try {
            $article = Article::where('slug', $slug)->first();
            if ($article == null) {
                return ResponseFormatter::error('', 'Article not found', 404);
            }
            $user = User::find(auth()->user()->id);
            $user->likeArticle($article->id);
            $article = Article::where('slug', $slug)->first();
            $article->liked = $article->likedArticle()->where('user_id',auth()->user()->id)->first()->status;
            event(new UserActivity(auth()->user()->id, 'Like Article', request()->ip()));
            return ResponseFormatter::success(['Success'], 200,'single');
        } catch (\Exception $e) {
            return ResponseFormatter::error('', $e->getMessage(), 500);
        }
    }

}
