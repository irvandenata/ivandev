<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\CustomException;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class InventoryController extends Controller
{
    protected $name = 'Data Inventory';
    protected $breadcrumb = '<strong>Data</strong> Inventory';
    protected $modul = 'inventory';
    protected $route = 'inventories';
    protected $view = 'admin.inventory';
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
        $this->newModel = new Inventory();
        $this->model = Inventory::query();
        $this->rows = [
            'name'=>['Serial Number','Room','Location','Name','Type','Condition','Category','Brand','image'],
            'column' => ['serial_number','room.name','room.location','equipment.name','equipment.type','condition','category','brand','image']
        ];
        $this->createLink = route('admin.inventories.create');
        $this->storeLink = route('admin.inventories.store');
        $this->indexLink = route('admin.inventories.index');
        $this->updateLink = 'admin.inventories.update';
        $this->editLink = 'admin.inventories.edit';
    }

    protected static function validateRequest($request, $type)
    {
        if ($type == 'create') {
            $result = Validator::make($request->all(), [
                'equipment_id' => 'required',
                'serial_number' => 'required',
                'installation_date'=> 'required',
                'photo' => 'mimes:jpeg,jpg,png,gif|max:10000',
                'price'=> 'required',
            ]);
        } else {
            $result = Validator::make($request->all(), [
                'equipment_id' => 'required',
                'serial_number' => 'required',
                'installation_date'=> 'required',
                'photo' => 'mimes:jpeg,jpg,png,gif|max:10000',

                'price'=> 'required',
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
            if($request->location != 'null'){
                $param = $request->location;
                $items->whereHas('room',function($q) use ($param){
                    $q->where('location',$param);
                });
            }
            if($request->room != 'null'){
                $param = $request->room;
                $items->whereHas('room',function($q) use ($param){
                    $q->where('name',$param);
                });
            }
            $items = $items->with(['equipment','room'])->latest()->get();
            return DataTables::of($items)
                ->addColumn('action', function ($item) {
                    return '
                           <a class="btn btn-danger btn-sm"  onclick="deleteItem(' . $item->id . ')"><i class="fas fa-trash text-white"></i></span></a> <a class="btn btn-warning btn-sm" href="' .route($this->editLink,$item->id) . '" ><i class="fas fa-eye text-white    "></i></span></a>';
                })
                ->addColumn('brand',function($item){
                    return $item->equipment->brand->name;
                })
                ->addColumn('category',function($item){
                    return $item->equipment->category->name;
                })
                ->addColumn('image',function($item){
                    return '<img src="'.asset($item->photo_url?('/storage/'.$item->photo_url):"assets/img/no-image.png").'" onClick="showImage(this)" class="cursor-pointer" width="50px" >';
                })
                ->addColumn('condition',function($item){
                    $condition = $item->complaints()->orderByDesc('handling_date')->first();
                    if($condition){
                        $condition = $condition->condition;
                    }else{
                        $condition=null;
                    }
                    if($condition == 1){
                        $name = 'Good';
                        $class = 'bg-success';
                    }else if($condition == 2){
                        $name = 'In Trouble';
                        $class = 'bg-warning';

                    } else if($condition == 3){
                        $name = 'Damaged';
                        $class = 'bg-danger';
                    }else{
                        $name = 'Good';
                        $class = 'bg-success';
                    }
                    return '<small class="px-2 rounded text-white text-center '.$class.'">'.$name.'</small>';
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action','image','condition'])
                ->make(true);
        }
        $data['title'] = $this->name;
        $data['breadcrumb'] = $this->breadcrumb;
        $data['rows'] = $this->rows;
        $data['createLink'] = $this->createLink;
        return view($this->view.'.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = $this->name . ' - Create';
        $data['breadcrumb'] =  $this->breadcrumb . ' - Create';
        $data['storeLink'] = $this->storeLink;
        $data['indexLink'] = $this->indexLink;
        return view($this->view.'.create', $data);
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
            if($request->photo){
                $item->photo_url = GlobalHelper::storeSingleImage($request->photo, $this->modul);
             }
            $item->equipment_id = $request->equipment_id;
            $item->room_id = $request->room_id;
            $item->serial_number = $request->serial_number;
            $item->installation_date = $request->installation_date;
            $item->price = $request->price;
            $item->save();
            DB::commit();
            return redirect($this->indexLink)->with('success', 'Data has been created');
        } catch (Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        } catch (CustomException $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getOptions());
        }

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
        try {
            $data['title'] = $this->name . ' - Detail';
            $data['breadcrumb'] = $this->name . ' - Detail';
            $data['item'] = $this->findById($id);
            if(!$data['item']) abort(404);
            $data['updateLink'] = route($this->updateLink,$id);
            $data['indexLink'] = $this->indexLink;
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
            $item->equipment_id = $request->equipment_id;
            $item->room_id = $request->room_id;
            $item->serial_number = $request->serial_number;
            $item->installation_date = $request->installation_date;
            $item->price = $request->price;
            $item->save();
            DB::commit();
            return redirect()->route($this->editLink,$item->id)->with('success', 'Data has been updated');
        } catch (Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        } catch (CustomException $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getOptions());
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
            $item->delete();
            return response()->json(['message' => "$this->name has been deleted !"], 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (CustomException $e) {
            return response()->json($e->getOptions(), 500);
        }
    }

}
