<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = Size::all();
        return view('size.index',['data'=>$queryBuilder]);
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
        $data = new Size();
        $data->name = $request->get('name');

        $data->save();

        return redirect()->route('sizes.index')->with('status','Kategori ukuran dengan nama: '.$data->name.' berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        $data=$size;

        return view('size.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size)
    {
        $size->name = $request->get('name');

        $size->save();

        return redirect()->route('sizes.index')->with('status','Kategori ukuran dengan nama: '.$size->name.' berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        try{
            $size->delete();
            return redirect()->route('sizes.index')->with('status','Kategori ukuran telah dihapus');
        }catch(\Exception $e){
            return redirect()->route('sizes.index')->with('error','Kategori ukuran tidak dapat dihapus, Pesan Error: '.$e->getMessage());
        }
    }

    public function showCreate(Request $request){
        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('size.create')->render()
        ),200);
    }

    public function showEdit(Request $request){
        $size=Size::find($_POST['id']);

        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('size.edit',['size'=>$size])->render()
        ),200);
    }
}
