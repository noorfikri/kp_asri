<?php

namespace App\Http\Controllers;

use App\Models\BuyingTransaction;
use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BuyingTranscationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        $queryBuilder = BuyingTransaction::all();
        return view('buyingtransaction.index',['data'=>$queryBuilder,'items'=>$items]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BuyingTransaction  $buyingTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(BuyingTransaction $buyingTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BuyingTransaction  $buyingTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(BuyingTransaction $buyingTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BuyingTransaction  $buyingTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BuyingTransaction $buyingTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BuyingTransaction  $buyingTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(BuyingTransaction $buyingTransaction)
    {
        //
    }

    public function showDetail(Request $request){
        $buyingTransaction = BuyingTransaction::with(['supplier','items'])->find($request->id);
        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('buyingtransaction.show',compact('buyingTransaction'))->render()
        ),200);
    }

    public function showCreate(Request $request)
    {
        $suppliers = Supplier::all();
        $items = Item::all();

        return response()->json(array(
            'status' => 'ok',
            'msg' => view('buyingtransaction.create', compact('items', 'suppliers'))->render()
        ), 200);
    }
}
