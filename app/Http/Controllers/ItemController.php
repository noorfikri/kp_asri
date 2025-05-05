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
        $data = new Item();
        $data->name = $request->get('name');
        $data->category_id = $request->get('category_id');
        $data->size_id = $request->get('size_id');
        $data->colour_id = $request->get('colour_id');
        $data->brand_id = $request->get('brand_id');
        $data->price = $request->get('price');
        $data->stock = $request->get('stock');
        $data->note = $request->get('note');

        $data->save();

        return redirect()->route('items.index')->with('status','Barang dengan nama: '.$data->name.' berhasil dibuat');
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
    public function edit(Request $request)
    {
        $item=Item::find($_POST['id']);
        $category = Category::all();
        $size = Size::all();
        $colour = Colour::all();
        $brand = Brand::all();

        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('item.edit',['item'=>$item,'category'=>$category,'size'=>$size,'colour'=>$colour,'brand'=>$brand])->render()
        ),200);
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
        $item->name = $request->get('name');
        $item->category_id = $request->get('category_id');
        $item->size_id = $request->get('size_id');
        $item->colour_id = $request->get('colour_id');
        $item->brand_id = $request->get('brand_id');
        $item->price = $request->get('price');
        $item->stock = $request->get('stock');
        $item->note = $request->get('note');

        $item->save();

        return redirect()->route('items.index')->with('status','Barang dengan nama: '.$item->name.' berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        try{
            $item->delete();
            return redirect()->route('items.index')->with('status','Barang telah dihapus');
        }catch(\Exception $e){
            return redirect()->route('items.index')->with('error','Barang tidak dapat dihapus, Pesan Error: '.$e->getMessage());
        }
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

    public function showEdit(Request $request){
        $item=Item::find($_POST['id']);
        $category = Category::all();
        $size = Size::all();
        $colour = Colour::all();
        $brand = Brand::all();

        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('item.edit',['item'=>$item,'category'=>$category,'size'=>$size,'colour'=>$colour,'brand'=>$brand])->render()
        ),200);
    }

    public function gallery()
    {
        $items = Item::all();
        return view('homepage/gallery', ['items' => $items]);
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $items = Item::where('name', 'LIKE', "%{$query}%")
            ->orWhere('note', 'LIKE', "%{$query}%")
            ->orWhereHas('category', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->orWhereHas('size', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->orWhereHas('colour', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->orWhereHas('brand', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->get();

        return view('item.search', ['items' => $items, 'query' => $query]);
    }
}
