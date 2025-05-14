<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\SellingTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SellingTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        $queryBuilder = SellingTransaction::all();
        return view('sellingtransaction.index',['data'=>$queryBuilder,'items'=>$items]);
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
        $items = $request->get('items');
        foreach ($items as $item) {
            $currentItem = Item::findOrFail($item['item_id']);
            if($currentItem->stock < $item['quantity']){
                return redirect()->route('sellingtransactions.index')->with('error', 'Transaksi tidak dapat dilakukan, Stok barang '.$currentItem->name.' tidak mencukupi untuk transaksi ini.');
            }
        }

        $transaction = new SellingTransaction();
        $transaction->seller_id = $request->get('seller_id');
        $transaction->date = $request->get('date');
        $transaction->discount_amount = $request->get('discount_amount');
        $transaction->total_amount = $request->get('total_amount');
        $transaction->sub_total = $request->get('sub_total');
        $transaction->total_count = $request->get('total_count');

        $transaction->save();

        $itemStr = "";

        foreach ($items as $item) {
            $currentItem = Item::findOrFail($item['item_id']);
            $itemStr = $itemStr.$currentItem->name.', ';
            $transaction->items()->attach($item['item_id'], [
                'total_quantity' => $item['quantity'],
                'total_price' => $item['price'],
            ]);
            $currentItem->stock -= $item['quantity'];
            $currentItem->save();
        }

        $transaction->save();

        return redirect()->route('sellingtransactions.index')->with('status', 'Transaksi penjualan mencakup barang: '.$itemStr.' dengan waktu '.$transaction->date.' berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SellingTransaction  $sellingTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(SellingTransaction $sellingTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SellingTransaction  $sellingTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(SellingTransaction $sellingTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SellingTransaction  $sellingTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SellingTransaction $sellingTransaction)
    {
        $sellingTransaction = SellingTransaction::findOrFail($request->id);
        $items = $request->get('items');

        $transactionItemsPivotTable = $sellingTransaction->items->keyBy('id');

        foreach ($items as $item) {
            $currentItem = Item::with('SellingTransactions')->find($item['item_id']);
            $transactionItem = $transactionItemsPivotTable->get($item['item_id']->pivot);

            if($item['quantity'] > $transactionItem->total_quantity){
                if($currentItem->stock < $item['quantity']){
                    return redirect()->route('sellingtransactions.index')->with('error', 'Transaksi tidak dapat dilakukan, Stok barang '.$currentItem->name.' tidak mencukupi untuk transaksi ini.');
                }
            }
        }

        $sellingTransaction->seller_id = $request->get('seller_id');
        $sellingTransaction->date = $request->get('date');
        $sellingTransaction->discount_amount = $request->get('discount_amount');
        $sellingTransaction->total_amount = $request->get('total_amount');
        $sellingTransaction->sub_total = $request->get('sub_total');
        $sellingTransaction->total_count = $request->get('total_count');

        $sellingTransaction->save();

        foreach ($items as $item) {
            $currentItem = Item::with('SellingTransactions')->find($item['item_id']);
            $transactionItem = $transactionItemsPivotTable->get($item['item_id'])->pivot;

            if($item['quantity'] > $transactionItem->total_quantity){
                $currentItem->stock -= $item['quantity'];
            } else {
                $currentItem->stock += ($transactionItem->total_quantity - $item['quantity']);
            }

            $currentItem->save();
        }

        $sellingTransaction->items()->detach();

        foreach ($items as $item) {
            $sellingTransaction->items()->attach($item['item_id'], [
                'total_quantity' => $item['quantity'],
                'total_price' => $item['price'],
            ]);
        }

        return redirect()->route('sellingtransactions.index')->with('status', 'Transaksi dengan waktu '.$sellingTransaction->date.' berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SellingTransaction  $sellingTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try{
            $sellingTransaction = SellingTransaction::findOrFail($id);
            $sellingTransaction->items()->detach();
            $sellingTransaction->delete();
            return redirect()->route('sellingtransactions.index')->with('status','Transaksi telah dihapus');
        }catch(\Exception $e){
            return redirect()->route('sellingtransactions.index')->with('error','Transaksi tidak dapat dihapus, Pesan Error: '.$e->getMessage());
        }
    }

    public function showDetail(Request $request){
        $sellingTransaction = SellingTransaction::with(['seller','items'])->find($request->id);
        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('sellingtransaction.show',compact('sellingTransaction'))->render()
        ),200);
    }

    public function showCreate(Request $request)
    {
        $users = User::all();
        $items = Item::all();

        return response()->json(array(
            'status' => 'ok',
            'msg' => view('sellingtransaction.create', compact('users', 'items'))->render()
        ), 200);
    }

    public function showEdit(Request $request)
    {
    $sellingTransaction = SellingTransaction::with(['seller', 'items'])->find($request->id);
    $users = User::all();
    $items = Item::all();

    return response()->json([
        'status' => 'ok',
        'msg' => view('sellingtransaction.edit', compact('sellingTransaction', 'users', 'items'))->render()
    ], 200);
    }

    public function deleteAddStock($id){
        try{
            $sellingTransaction = SellingTransaction::findOrFail($id);
            $items = $sellingTransaction->items->keyBy('id');
            foreach($items as $item){
                $transactionItems = $items->get($item->id)->pivot;
                $item->stock+=$transactionItems->total_quantity;
                $item->save();
            }
            $sellingTransaction->items()->detach();
            $sellingTransaction->delete();
            return redirect()->route('sellingtransactions.index')->with('status','Transaksi telah dihapus dan stock barang telah ditambakan kembali');
        }catch(\Exception $e){
            return redirect()->route('sellingtransactions.index')->with('error','Transaksi tidak dapat dihapus, Pesan Error: '.$e->getMessage());
        }
    }
}
