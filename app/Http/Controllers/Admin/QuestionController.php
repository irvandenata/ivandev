<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\CustomException;
use App\Helpers\GlobalFunction;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Models\CategoryQuestion;
use App\Models\OptionQuestion;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class QuestionController extends Controller
{
    protected $name = 'Data Question';
    protected $breadcrumb = '<strong>Data</strong> Question';
    protected $modul = 'question';
    protected $route = 'questions';
    protected $view = 'admin.question';
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
        $this->newModel = new Question();
        $this->model = Question::query();
        $this->rows = [
            'name'=>['Status','Category','Question','Image'],
            'column' => ['status','category','question','image'],
        ];
        $this->createLink = route('admin.questions.create');
        $this->storeLink = route('admin.questions.store');
        $this->indexLink = route('admin.questions.index');
        $this->updateLink = 'admin.questions.update';
        $this->editLink = 'admin.questions.edit';
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
                           <a class="btn btn-danger btn-sm"  onclick="deleteItem(' . $item->id . ')"><i class="fas fa-trash text-white"></i></span></a> <a class="btn btn-warning btn-sm" href="' .route($this->editLink,$item->id) . '" ><i class="fas fa-eye text-white    "></i></span></a>';
                })
                ->addColumn('image',function($item){
                    return '<img src="'.asset($item->image?('/storage/'.$item->image):"assets/img/no-image.png").'" onClick="showImage(this)" class="cursor-pointer" width="50px" >';
                })
                ->addColumn('category',function($item){
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
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action','image','status','question'])
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
        $data['categories']= CategoryQuestion::get();

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
            if($request->image){
                $item->image = GlobalFunction::storeSingleImage($request->image, $this->modul);
             }
            $item->category_id = $request->category_id;
            $item->question = $request->question;
            $item->explanation = $request->explanation;
            $item->save();
             foreach ($request->option as $key => $value) {
                $option = new OptionQuestion();
                $option->question_id = $item->id;
                $option->option = $value;
                if($request->answer == $key+1){
                    $option->is_correct = 1;
                }
                $option->save();
            }
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
        $data['categories']= CategoryQuestion::get();

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
            if (!$item) {
                throw new CustomException("error", 404, null, ["Data not found"]);
            }
            if($request->image){
                $item->image = GlobalFunction::storeSingleImage($request->image, $this->modul);
            }
            $item->category_id = $request->category_id;
            $item->question = $request->question;
            $item->explanation = $request->explanation;
            $item->save();
             foreach($item->options as $key => $value){
                $value->delete();
            }
             foreach ($request->option as $key => $value) {
                $option = new OptionQuestion();
                $option->question_id = $item->id;
                $option->option = $value;
                if($request->answer == $key+1){
                    $option->is_correct = 1;
                }
                $option->save();
            }


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
            if($item->image){
                GlobalFunction::deleteSingleImage($item->image);
            }
            foreach($item->options as $key => $value){
                $value->delete();
            }
            $item->delete();
            return response()->json(['message' => "$this->name has been deleted !"], 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
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
