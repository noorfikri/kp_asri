<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = Category::all();
        return view('category.index',['data'=>$queryBuilder]);
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
        $data = new Category();
        $data->name = $request->get('name');

        $data->save();

        return redirect()->route('categories.index')->with('status','Kategori dengan nama: '.$data->name.' berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->get('name');

        $category->save();

        return redirect()->route('categories.index')->with('status','Kategori dengan nama: '.$category->name.' berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try{
            $category->delete();
            return redirect()->route('categories.index')->with('status','Kategori telah dihapus');
        }catch(\Exception $e){
            return redirect()->route('categories.index')->with('error','Kategori tidak dapat dihapus, Pesan Error: '.$e->getMessage());
        }
    }

    public function showCreate(Request $request){
        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('category.create')->render()
        ),200);
    }

    public function showEdit(Request $request){
        $category=Category::find($_POST['id']);

        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('category.edit',['category'=>$category])->render()
        ),200);
    }
}
