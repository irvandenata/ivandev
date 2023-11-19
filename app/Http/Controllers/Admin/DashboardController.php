<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\CustomException;
use App\Helpers\GlobalHelper;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\CategoryQuestion;
use App\Models\User;

class DashboardController extends Controller
{
    protected $name = 'Dashboard';
    protected $modul = 'dashboards';

    public function __construct()
    {
        // $this->newModel = new Slider();
        // $this->model = Slider::query();
    }

    protected static function validateRequest ($request){
        $result = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'subtitle' => 'max:255',
            'image'=> 'mimes:jpeg,jpg,png,gif|max:10000',
            'order'=> 'required|numeric',
        ]);
        return $result ;
    }
    protected function findById($id){
        $model = clone $this->model;
        return  $model->where('id', $id)->first();
    }
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data['title'] = $this->name;
        $data['breadcrumb'] = $this->name;
        $today = date('Y-m-d');
        
        return view('admin.dashboard', $data);
    }

}
