<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Word;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            if(strlen($request->search['value'])>=2){
               $items = Word::where('word', 'like', '%' . $request->search['value'] . '%')->get();

            }else{
                $items = [];
            }


            return DataTables::of($items)
                ->addColumn('action', function ($item) {
                    return '<a class="btn btn-danger btn-sm"  onclick="deleteItem(' . $item->id . ')"><i class="fa fa-trash"></i></span></a>' . '<a class="btn btn-warning btn-sm" onclick="editItem(' . $item->id . ')"><i class="fa fa-pencil-alt"></i></span></a>';
                })
                ->addColumn('language', function ($item) {
                    return $item->language != null ? $item->language->name . "-" . $item->language->code : "-";
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        $data['languages'] = Language::orderBy('name', 'asc')->get();
        $data['title'] = "WORDS";
        return view('word.index', $data);
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
    public function store(Request $request)
    {
        try {
            $item = new Word();
            $item->word = $request->word;
            $item->mean = $request->mean;
            $item->language_id = $request->language_id;
            $item->save();
            return response()->json(['message' => 'Data berhasil ditambahkan', 'status' => 200]);

        } catch (\Exception$e) {
            return response()->json(['message' => $e], 500);

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
    public function edit(Word $word)
    {
        return $word;
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Word $word)
    {
        try {
            $word->word = $request->word;
            $word->mean = $request->mean;
            $word->language_id = $request->language_id;
            $word->save();


        } catch (\Exception$e) {
            return response()->json(['message' => $e], 500);
        }
        return response()->json(['message' => 'Data berhasil diubah', 'status' => 200]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Word $word)
    {
        try {
            $word->delete();

        } catch (Exception $e) {
            return response()->json(['message' => 'Proses Gagal'], 500);

        }

    }

    public function getWord(Request $request)
    {
        if(strlen($request->q)>1)
            $word = Word::where('language_id', $request->lang)->where('word','like',"%".$request->q."%")->get();
        else{
             $word = [];
        }
        return $word;
    }
}
