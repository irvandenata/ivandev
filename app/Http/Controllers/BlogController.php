<?php

namespace App\Http\Controllers;

use App\Models\ActivityCategory;
use App\Models\AdditionalInfo;
use App\Models\Article;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(request()->search){
            $data['projects'] = Article::whereHas('category', function ($query) {
                $query->where('name', '!=','Project');
            })->where('title','like','%'.request()->search.'%')->orderBy('created_at','desc')->paginate(8);
        }else{
            $data['projects'] = Article::whereHas('category', function ($query) {
                $query->where('name', '!=','Project');
            })->orderBy('created_at','desc')->paginate(8);
        }
        $data['articles'] ='';
        return view('blog.search',$data);
    }

    public function project()
    {
        if(request()->search){
            $data['projects'] = Article::whereHas('category', function ($query) {
                $query->where('name', 'Project');
            })->where('title','like','%'.request()->search.'%')->orderBy('created_at','desc')->paginate(8);
        }else{
            $data['projects'] = Article::whereHas('category', function ($query) {
                $query->where('name', 'Project');
            })->orderBy('created_at','desc')->paginate(8);
        }
        $data['articles'] ='';


        return view('blog.search',$data);
    }



    public function show ($slug){
        $data['article'] = Article::where('slug',$slug)->first();
        return view('blog.detail',$data);
    }
}
