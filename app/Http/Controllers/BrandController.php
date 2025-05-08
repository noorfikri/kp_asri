<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = Brand::all();
        return view('brand.index',['data'=>$queryBuilder]);
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
        $data = new Brand();
        $data->name = $request->get('name');

        $data->save();

        return redirect()->route('brands.index')->with('status','Brand dengan nama: '.$data->name.' berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $brand->name = $request->get('name');

        $brand->save();

        return redirect()->route('brands.index')->with('status','Brand dengan nama: '.$brand->name.' berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        try{
            $brand->delete();
            return redirect()->route('brands.index')->with('status','Brand telah dihapus');
        }catch(\Exception $e){
            return redirect()->route('brands.index')->with('error','Brand tidak dapat dihapus, Pesan Error: '.$e->getMessage());
        }
    }


    public function showCreate(Request $request){
        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('brand.create')->render()
        ),200);
    }

    public function showEdit(Request $request){
        $brand=Brand::find($_POST['id']);

        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('brand.edit',['brand'=>$brand])->render()
        ),200);
    }
}
