<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DeleteAccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['title'] = "DASHBOARD";
        return view('home',$data);
    }

    public function delete(Request $request){
        $user = User::where('id',auth()->user()->id)->first();
        if($user->email != $request->email){
            abort(403);
        }
        $user->delete();
        return redirect()->route('login');
    }
}
