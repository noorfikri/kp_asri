<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Colour;
use App\Models\Item;
use App\Models\Size;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        $size = Size::all();
        $colour = Colour::all();
        $brand = Brand::all();

        $queryBuilder = Item::all();
        return view('item.index',['data'=>$queryBuilder,'category'=>$category,'size'=>$size,'colour'=>$colour,'brand'=>$brand]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = Category::all();
        $size = Size::all();
        $colour = Colour::all();
        $brand = Brand::all();

        return view('item.create',['category'=>$category,'size'=>$size,'colour'=>$colour,'brand'=>$brand]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $data=$item;

        return view('item.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $data = $item;
        $category = Category::all();
        $size = Size::all();
        $colour = Colour::all();
        $brand = Brand::all();

        return view('item.edit',['category'=>$category,'size'=>$size,'colour'=>$colour,'brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }

    public function showDetail(Request $request){
        $data=Item::find($_POST['id']);
        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('item.show',compact('data'))->render()
        ),200);
    }

    public function showCreate(Request $request){
        $category = Category::all();
        $size = Size::all();
        $colour = Colour::all();
        $brand = Brand::all();

        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('item.create',['category'=>$category,'size'=>$size,'colour'=>$colour,'brand'=>$brand])->render()
        ),200);
    }
}
