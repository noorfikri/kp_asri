<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = Supplier::all();
        return view('supplier.index',['data'=>$queryBuilder]);
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
        $data = new Supplier();
        $data->name = $request->get('name');
        $data->address = $request->get('address');
        $data->telephone = $request->get('telephone');

        $image = $request->file('picture');
        if($image){
            $data->picture = App::call([new FileUploadService, 'uploadFile'], ['file' => $image, 'filename' => $data->name, 'folder' => 'supplier']);
        }

        $data->save();

        return redirect()->route('suppliers.index')->with('status','Supplier dengan nama: '.$data->name.' berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $supplier->name = $request->get('name');
        $supplier->address = $request->get('address');
        $supplier->telephone = $request->get('telephone');

        $image = $request->file('picture');
        if($image){
            $supplier->picture = App::call([new FileUploadService, 'uploadFile'], ['file' => $image, 'filename' => $supplier->name, 'folder' => 'supplier']);
        }

        $supplier->save();

        return redirect()->route('suppliers.index')->with('status','Supplier dengan nama: '.$supplier->name.' berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        try{
            $supplier->delete();
            return redirect()->route('suppliers.index')->with('status','Supplier telah dihapus');
        }catch(\Exception $e){
            return redirect()->route('suppliers.index')->with('error','Supplier tidak dapat dihapus, Pesan Error: '.$e->getMessage());
        }
    }

    public function showDetail(Request $request){
        $data=Supplier::find($_POST['id']);
        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('supplier.show',compact('data'))->render()
        ),200);
    }

    public function showCreate(Request $request){
        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('supplier.create')->render()
        ),200);
    }

    public function showEdit(Request $request){
        $supplier=Supplier::find($_POST['id']);

        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('supplier.edit',['supplier'=>$supplier])->render()
        ),200);
    }
}
