<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Category::latest()->orderBy('name','asc')->get();

            return DataTables::of($items)
                ->addColumn('action', function ($item) {
                    return '<a class="btn btn-danger btn-sm"  onclick="deleteItem(' . $item->id . ')"><i class="fa fa-trash"></i></span></a>' . '<a class="btn btn-warning btn-sm" onclick="editItem(' . $item->id . ')"><i class="fa fa-pencil-alt"></i></span></a>'.'<a class="btn btn-primary btn-sm" href="/admin/category/' . $item->username . '"><i class="fa fa-eye"></i></span></a>';
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        $data['title'] = "CATEGORY WORDS";
        return view('category.index', $data);
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
            $item = new Category();
            $item->name = $request->name;
            $item->description = $request->description;
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
    public function edit(Category $category)
    {
        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try {
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();
            return response()->json(['message' => 'Data berhasil diubah', 'status' => 200]);

        } catch (\Exception$e) {
            return response()->json(['message' => $e], 500);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();

        } catch (Exception $e) {
            return response()->json(['message' => 'Proses Gagal'], 500);

        }

    }
}
