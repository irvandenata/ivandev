<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GlobalFunction;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Article;
use App\Models\ArticleCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    protected $name = 'Article';
    protected $breadcrumb = '<strong>Data</strong> Article';
    protected $modul = 'article';
    protected $route = 'articles';
    protected $view = 'admin.article';
    protected $newModel;
    protected $model;
    protected $rows;
    protected $createLink;
    protected $storeLink;
    protected $indexLink;
    protected $updateLink;
    protected $editLink;

    public function __construct()
    {
        $this->newModel = new Article();
        $this->model = Article::query();
        $this->rows = [
            'name' => ['Status', 'Title', 'Category', 'Source',"Cover",'Create Date'],
            'column' => ['status', 'title', 'category_id','source','image', 'created_at'],
        ];
        $this->createLink = route('admin.articles.create');
        $this->storeLink = route('admin.articles.store');
        $this->indexLink = route('admin.articles.index');
        $this->updateLink = 'admin.articles.update';
        $this->editLink = 'admin.articles.edit';
    }

    protected static function validateRequest($request, $type)
    {
        if ($type == 'create') {
            $result = Validator::make($request->all(), [
                // 'equipment_id' => 'required',
                // 'serial_number' => 'required',
                // 'installation_date'=> 'required',
                // 'photo' => 'mimes:jpeg,jpg,png,gif|max:10000',
                // 'price'=> 'required',
            ]);
        } else {
            $result = Validator::make($request->all(), [
                // 'equipment_id' => 'required',
                // 'serial_number' => 'required',
                // 'installation_date'=> 'required',
                // 'photo' => 'mimes:jpeg,jpg,png,gif|max:10000',

                // 'price'=> 'required',
            ]);
        }

        return $result;
    }
    protected function findById($id)
    {
        $model = clone $this->model;
        return $model->where('id', $id)->first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = $this->model;
            $items = $items->latest()->get();
            return DataTables::of($items)
                ->addColumn('action', function ($item) {
                    return '
                           <a class="btn btn-danger btn-sm"  onclick="deleteItem(' . $item->id . ')"><i class="fas fa-trash text-white"></i></span></a> <a class="btn btn-warning btn-sm" href="' . route($this->editLink, $item->id) . '" ><i class="fas fa-eye text-white    "></i></span></a>';
                })
                ->editColumn('category_id',function($item){
                    return $item->category->name;
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == 1) {
                        $name = 'Active';
                        $class = 'btn-success';
                    } else if ($item->status == 0) {
                        $name = 'Inactive';
                        $class = 'btn-warning';

                    }
                    return '<button onClick="controlShow(' . $item->id . ')" class="btn px-2 rounded text-white text-center status ' . $class . '">' . $name . '</button>';
                })
                ->editColumn('image',function($item){
                    return '<img src="'.asset($item->image?('/storage/'.$item->image):"assets/img/no-image.png").'" onClick="showImage(this)" class="cursor-pointer" width="50px" >';
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action', 'status','image'])
                ->make(true);
        }
        $data['title'] = $this->name;
        $data['breadcrumb'] = $this->breadcrumb;
        $data['rows'] = $this->rows;
        $data['createLink'] = $this->createLink;
        return view($this->view . '.index', $data);
    }

    /**
     * Show the form for creating a new resource.i
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = $this->name . ' - Create';
        $data['breadcrumb'] = $this->breadcrumb . ' - Create';
        $data['storeLink'] = $this->storeLink;
        $data['indexLink'] = $this->indexLink;
        $data['categories'] = ArticleCategory::where('status',1)->get();
        return view($this->view . '.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $v = $this->validateRequest($request, 'create');
            if ($v->fails()) {
                throw new CustomException("error", 401, null, $v->errors()->all());
            }
            $item = $this->newModel;
            $slug = explode(' ', $request->title);
            $slug = implode('-', $slug);
            $slug = strtolower($slug);
            $check = Article::where('slug', $slug)->exists();
            if ($check) {
                $slug = $slug . '-' . rand(1, 100);
            }

            if($request->hasFile('image')){
                $item->image = GlobalFunction::storeSingleImage($request->image, $this->modul);
            }

            $item->title = $request->title;
            $item->slug = $slug;
            $item->body = $request->body;
            $item->source = $request->source;
            $item->category_id = $request->category_id;
            $item->save();
            DB::commit();
            return redirect()->route($this->editLink,$item->id)->with('success', 'Data has been created');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        } catch (CustomException $e) {
            DB::rollback();
            return redirect()->back()->with('errors', $e->getOptions());
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($articlename)
    {
        $data['title'] = "PENGGUNA";
        $data['languages'] = Language::orderBy('name', 'asc')->get();
        $data['article'] = Article::where('articlename', $articlename)->with('languages')->first();
        return view('article.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data['title'] = $this->name . ' - Detail';
            $data['breadcrumb'] = $this->name . ' - Detail';
            $data['item'] = $this->findById($id);
            if(!$data['item']) abort(404);
            $data['updateLink'] = route($this->updateLink,$id);
            $data['indexLink'] = $this->indexLink;
            $data['categories'] = ArticleCategory::where('status',1)->get();
            return view($this->view.'.edit', $data);
        } catch (\Throwable $th) {
            abort(404);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $v = $this->validateRequest($request, 'edit');
            if ($v->fails()) {
                throw new CustomException('error', 401, null, $v->errors()->all());
            }
            $item = $this->findById($id);
            $slug = explode(' ', $request->title);
            $slug = implode('-', $slug);
            $slug = strtolower($slug);
            $check = Article::where('slug', $slug)->where('id', '!=', $id)->exists();
            if ($check) {
                $slug = $slug . '-' . rand(1, 100);
            }

            if($request->hasFile('image')){
                $item->image = GlobalFunction::updateSingleImage($request->image, $this->modul, $item->image);
            }

            $item->title = $request->title;
            $item->slug = $slug;
            $item->source = $request->source;
            $item->body = $request->body;
            $item->category_id = $request->category_id;

            $item->save();
            DB::commit();
            return redirect()->route($this->editLink,$item->id)->with('success', 'Data has been updated');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        } catch (CustomException $e) {
            DB::rollback();
            return redirect()->back()->with('errors', $e->getOptions());
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $item = $this->findById($id);
            if (!$item) {
                throw new CustomException("error", 404, null, ["Data not found"]);
            }
            if($item->image){
                GlobalFunction::deleteSingleImage($item->image);
            }
            $item->delete();
            return response()->json(['message' => "$this->name has been deleted !"], 200);
        }  catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        } catch (CustomException $e) {
            DB::rollback();
            return redirect()->back()->with('errors', $e->getOptions());
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function changeShow ($id){
        $item = $this->findById($id);
        if ($item->status == 1) {
            $item->status = 0;
        } else {
            $item->status = 1;
        }
        $item->save();
        return response()->json(['message' => 'Data berhasil diubah', 'status' => 200]);
    }

}
