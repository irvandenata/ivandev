<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryWord;
use App\Models\Language;
use App\Models\Word;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryWordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = CategoryWord::latest()->get();
            return DataTables::of($items)
                ->addColumn('action', function ($item) {
                    return '<a class="btn btn-danger btn-sm"  onclick="deleteItem(' . $item->id . ')"><i class="fa fa-trash"></i></span></a>' . '<a class="btn btn-warning btn-sm" onclick="editItem(' . $item->id . ')"><i class="fa fa-pencil-alt"></i></span></a>';
                })
                ->addColumn('word', function ($item) {
                    $w = Word::where('id', $item->word_id)->first();
                    return $w->word . " : " . $w->language->name;

                })
                ->addColumn('mean', function ($item) {
                    return Word::where('id', $item->word_id)->first()->mean;

                })
                ->addColumn('category', function ($item) {
                    return Category::where('id', $item->category_id)->first()->name;
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        $data['languages'] = Language::orderBy('name', 'asc')->get();
        $data['categories'] = Category::orderBy('name', 'asc')->get();
        $data['title'] = "Category Words";
        return view('categoryWord.index', $data);
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
            $item = new CategoryWord();
            $item->word_id = $request->word_id;
            $item->category_id = $request->category_id;
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
    public function edit(CategoryWord $categoryWord)
    {
        $word = Word::where('id', $categoryWord->word_id)->first();
        $categoryWord->language_id = $word->language_id;
        $categoryWord->detail = $word->word . " : " . $word->mean;
        return $categoryWord;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryWord $categoryWord)
    {
        try {
            $categoryWord->word_id = $request->word_id;
            $categoryWord->category_id = $request->category_id;
            $categoryWord->save();
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
    public function destroy(CategoryWord $categoryWord)
    {
        try {
            $categoryWord->delete();

        } catch (Exception $e) {
            return response()->json(['message' => 'Proses Gagal'], 500);

        }
    }

}
