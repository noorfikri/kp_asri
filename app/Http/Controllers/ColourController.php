<?php

namespace App\Http\Controllers;

use App\Models\Colour;
use Illuminate\Http\Request;

class ColourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = Colour::all();
        return view('colour.index',['data'=>$queryBuilder]);
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
        $data = new Colour();
        $data->name = $request->get('name');

        $data->save();

        return redirect()->route('colours.index')->with('status','Warna dengan nama: '.$data->name.' berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Colour  $colour
     * @return \Illuminate\Http\Response
     */
    public function show(Colour $colour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Colour  $colour
     * @return \Illuminate\Http\Response
     */
    public function edit(Colour $colour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Colour  $colour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Colour $colour)
    {
        $colour->name = $request->get('name');

        $colour->save();

        return redirect()->route('colours.index')->with('status','Warna dengan nama: '.$colour->name.' berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Colour  $colour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Colour $colour)
    {
        try{
            $colour->delete();
            return redirect()->route('colours.index')->with('status','Warna telah dihapus');
        }catch(\Exception $e){
            return redirect()->route('colours.index')->with('error','Warna tidak dapat dihapus, Pesan Error: '.$e->getMessage());
        }
    }

    public function showCreate(Request $request){
        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('colour.create')->render()
        ),200);
    }

    public function showEdit(Request $request){
        $colour=Colour::find($_POST['id']);

        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('colour.edit',['colour'=>$colour])->render()
        ),200);
    }
}
