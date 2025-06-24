<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemStock;
use App\Models\SellingTransaction;
use App\Models\SellingTransactionItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SellingTransactionController extends Controller
{
    /**
     * Display a listing of the selling transactions.
     */
    public function index()
    {
        $sellingTransactions = SellingTransaction::with(['seller'])->get();
        return view('sellingtransaction.index', ['data' => $sellingTransactions]);
    }

    /**
     * Show the form for creating a new selling transaction.
     */
    public function create()
    {
        // Not used, handled via AJAX modal
    }

    /**
     * Store a newly created selling transaction in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'seller_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.items_stock_id' => 'required|exists:items_stock,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|integer|min:0',
            'sub_total' => 'required|integer|min:0',
            'total_count' => 'required|integer|min:0',
            'discount_amount' => 'nullable|integer|min:0',
            'total_amount' => 'required|integer|min:0',
        ]);

        foreach ($validated['items'] as $item) {
            $stock = \App\Models\ItemStock::findOrFail($item['items_stock_id']);
            if ($stock->stock < $item['quantity']) {
                 return redirect()->route('sellingtransactions.index')->with('error', 'Stok tidak cukup untuk transaksi.');
                }
        }

        try {
            $transaction = new \App\Models\SellingTransaction();
            $transaction->seller_id = $validated['seller_id'];
            $transaction->date = $validated['date'];
            $transaction->discount_amount = $validated['discount_amount'] ?? 0;
            $transaction->total_amount = $validated['total_amount'];
            $transaction->sub_total = $validated['sub_total'];
            $transaction->total_count = $validated['total_count'];
            $transaction->save();


            foreach ($validated['items'] as $item) {
                \App\Models\SellingTransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'items_stock_id' => $item['items_stock_id'],
                    'total_quantity' => $item['quantity'],
                    'total_price' => $item['price'],
                ]);
                $stock = \App\Models\ItemStock::find($item['items_stock_id']);
                $stock->stock -= $item['quantity'];
                $stock->save();
            }

            return redirect()->route('sellingtransactions.index')->with('status', 'Transaksi penjualan berhasil dibuat.');
        } catch (\Exception $e) {
            Log::error('SellingTransaction store failed', ['error' => $e->getMessage()]);
            return redirect()->route('sellingtransactions.index')->with('error', 'Gagal membuat transaksi penjualan: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified selling transaction in storage.
     */
    public function update(Request $request, SellingTransaction $sellingTransaction)
    {

    }

    /**
     * Remove the specified selling transaction from storage.
     */
    public function destroy(Request $request, $id)
    {
        try {
            $sellingTransaction = SellingTransaction::findOrFail($id);
            $sellingTransaction->itemsStocks()->detach();
            $sellingTransaction->delete();
            return redirect()->route('sellingtransactions.index')->with('status', 'Transaksi telah dihapus');
        } catch (\Exception $e) {
            return redirect()->route('sellingtransactions.index')->with('error', 'Transaksi tidak dapat dihapus, Pesan Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified selling transaction and restore item stock.
     */
    public function deleteAddStock($id)
    {
        try {
            $sellingTransaction = SellingTransaction::findOrFail($id);
            foreach ($sellingTransaction->itemsStocks as $itemStock) {
                $pivot = $itemStock->pivot;
                $itemStock->stock += $pivot->total_quantity;
                $itemStock->save();
            }
            $sellingTransaction->itemsStocks()->detach();
            $sellingTransaction->delete();

            return redirect()->route('sellingtransactions.index')->with('status', 'Transaksi telah dihapus dan stok barang telah dikembalikan');
        } catch (\Exception $e) {
            Log::error('SellingTransaction delete failed', ['error' => $e->getMessage()]);
            return redirect()->route('sellingtransactions.index')->with('error', 'Transaksi tidak dapat dihapus, Pesan Error: ' . $e->getMessage());
        }
    }

    /**
     * Show the detail modal via AJAX.
     */
    public function showDetail(Request $request)
    {
        $sellingTransaction = SellingTransaction::with(['seller', 'itemsStocks'])->find($request->id);
        return response()->json([
            'status' => 'ok',
            'msg' => view('sellingtransaction.show', compact('sellingTransaction'))->render()
        ], 200);
    }

    /**
     * Show the create modal via AJAX.
     */
    public function showCreate(Request $request)
    {
        $users = User::all();
        $itemsStock = ItemStock::with(['item', 'size', 'colour'])->get();

        return response()->json([
            'status' => 'ok',
            'msg' => view('sellingtransaction.create', compact('users', 'itemsStock'))->render()
        ], 200);
    }

    /**
     * Show the edit modal via AJAX.
     */
    public function showEdit(Request $request)
    {
        $sellingTransaction = SellingTransaction::with(['seller', 'itemsStocks'])->find($request->id);
        $users = User::all();
        $items = Item::all();

        return response()->json([
            'status' => 'ok',
            'msg' => view('sellingtransaction.edit', compact('sellingTransaction', 'users', 'items'))->render()
        ], 200);
    }
}
