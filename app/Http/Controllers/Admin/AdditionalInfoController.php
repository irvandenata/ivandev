<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GlobalFunction;
use App\Http\Controllers\Controller;
use App\Models\AdditionalInfo;
use App\Models\AdditionalType;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AdditionalInfoController extends Controller
{
    protected $name = 'Additional Informastions';
    protected $breadcrumb = '<strong>Data</strong> Additional Informastions';
    protected $modul = 'additional-info';
    protected $route = 'additional-infos';
    protected $view = 'admin.additional-info';
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
        $this->newModel = new AdditionalInfo();
        $this->model = AdditionalInfo::query()->with('type');
        $this->rows = [
            'name'=>['Status','Title','Sub Title','Type','Description','Image','Icon','Start - End Date'],
            'column' => ['status','title','sub_title','type','description','image','icon','start_end_date']
        ];
        $this->createLink = route('admin.additional-infos.create');
        $this->storeLink = route('admin.additional-infos.store');
        $this->indexLink = route('admin.additional-infos.index');
        $this->updateLink = 'admin.additional-infos.update';
        $this->editLink = 'admin.additional-infos.edit';
    }

    protected static function validateRequest($request, $type)
    {
        if ($type == 'create') {
            $result = Validator::make($request->all(), [
                'title' => 'required',
            ]);
        } else {
            $result = Validator::make($request->all(), [
                'title' => 'required',
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
            $items = $this->model->latest();
            return DataTables::of($items)
                ->addColumn('action', function ($item) {
                    return '
                           <a class="btn btn-danger btn-sm"  onclick="deleteItem(' . $item->id . ')"><i class="fas fa-trash text-white"></i></span></a> <a class="btn btn-warning btn-sm" onclick="editItem('.$item->id.')" ><i class="fas fa-pencil text-white    "></i></span></a>';
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
                ->addColumn('start_end_date', function ($item) {
                    return $item->start_date.' - '.$item->end_date;
                })
                ->editColumn('image',function($item){
                    return '<img src="'.asset($item->image?('/storage/'.$item->image):"assets/img/no-image.png").'" onClick="showImage(this)" class="cursor-pointer" width="50px" >';
                })
                ->editColumn('icon',function($item){
                    return $item->icon;
                })
                ->addColumn('type',function($item){
                    return $item->type->name;
                })
                ->editColumn('description',function($item){
                    return substr($item->description,0,100);
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action','status','image','description','icon','start_end_date'])
                ->make(true);
        }
        $data['title'] = $this->name;
        $data['breadcrumb'] = $this->breadcrumb;
        $data['rows'] = $this->rows;
        $data['createLink'] = $this->createLink;
        $data['view'] = $this->view;
        $data['types'] = AdditionalType::where('status',1)->get();
        return view($this->view.'.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            $item->title = $request->title;
            $item->sub_title = $request->sub_title;
            $item->description = $request->description;
            $item->start_date = $request->start_date;
            $item->end_date = $request->end_date;
            $item->additional_type_id = $request->additional_type_id;
            if($request->image){
                $item->image = GlobalFunction::storeSingleImage($request->image, $this->modul);
             }

                $item->icon = $request->icon;

            $item->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e->getOptions(), 500);
        } catch (CustomException $e) {
            DB::rollback();
            return response()->json($e->getOptions(),$e->getCode());
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json(['message' => "$this->name has been created !", "data" => $item], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryQuestion = $this->findById($id);
        return $categoryQuestion;
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
            $item->title = $request->title;
            $item->sub_title = $request->sub_title;
            $item->description = $request->description;
            $item->start_date = $request->start_date;
            $item->end_date = $request->end_date;
            $item->additional_type_id = $request->additional_type_id;
            if($request->image){
                $item->image = GlobalFunction::updateSingleImage($request->image, $this->modul, $item->image);
             }
             $item->icon = $request->icon;
            $item->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e->getOptions(), 500);
        } catch (CustomException $e) {
            DB::rollback();
            return response()->json($e->getOptions(),$e->getCode());
        }
        return response()->json(['message' => "$this->name has been updated !", "data" => $item], 200);
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
            if(!$item){
                throw new CustomException("error", 404, null, ["Data not found"]);
            }
            if($item->image){
                GlobalFunction::deleteSingleImage($item->image);
            }

            $item->delete();
            return response()->json(['message' => "$this->name has been deleted !"], 200);
        }catch (Exception $e) {
            return response()->json($e->getOptions(), 500);
        } catch (CustomException $e) {
            return response()->json($e->getOptions(), 500);
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
