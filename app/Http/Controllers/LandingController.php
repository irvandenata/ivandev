<?php

namespace App\Http\Controllers;

use App\Models\ActivityCategory;
use App\Models\AdditionalInfo;
use App\Models\Article;
use App\Models\Message;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class LandingController extends Controller
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
      $data['title'] = 'Home';
        $data['user'] = User::first();
        $data['techStack'] = AdditionalInfo::whereHas('type', function ($query) {
            $query->where('name', 'Tech Stack');
        })->get();

        $data['workExp'] = AdditionalInfo::whereHas('type', function ($query) {
            $query->where('name', 'Work Experiences');
        })->orderBy('end_date','desc')->get();
        $data['projects'] = Article::whereHas('category', function ($query) {
            $query->where('name', 'Project');
        })->orderBy('created_at','desc')->paginate(4);

        return view('landing',$data);
    }

    public function sitemap (){
        $data['sitemap'] = Article::get();
        return view('sitemap',$data);
    }

    public function getInTouch (Request $request){
       $message = new Message();
         $message->name = $request->name;
            $message->email = $request->email;
            $message->message = $request->message;
            $message->save();
            return response()->json(['status' => 'success', 'message' => 'Message sent successfully']);
    }
}
