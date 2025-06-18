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
     * Display a listing of the selling transactions.
     */
    public function index()
    {
        $items = Item::all();
        $sellingTransactions = SellingTransaction::all();
        return view('sellingtransaction.index', ['data' => $sellingTransactions, 'items' => $items]);
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
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|integer|min:0',
            'sub_total' => 'required|integer|min:0',
            'total_count' => 'required|integer|min:0',
            'discount_amount' => 'nullable|integer|min:0',
            'total_amount' => 'required|integer|min:0',
        ]);

        // Check stock before proceeding
        foreach ($validated['items'] as $item) {
            $currentItem = Item::findOrFail($item['item_id']);
            if ($currentItem->stock < $item['quantity']) {
                return redirect()->route('sellingtransactions.index')->with('error', 'Transaksi tidak dapat dilakukan, Stok barang ' . $currentItem->name . ' tidak mencukupi untuk transaksi ini.');
            }
        }

        try {
            $transaction = new SellingTransaction();
            $transaction->seller_id = $validated['seller_id'];
            $transaction->date = $validated['date'];
            $transaction->discount_amount = $validated['discount_amount'] ?? 0;
            $transaction->total_amount = $validated['total_amount'];
            $transaction->sub_total = $validated['sub_total'];
            $transaction->total_count = $validated['total_count'];
            $transaction->save();

            $itemStr = "";

            foreach ($validated['items'] as $item) {
                $currentItem = Item::findOrFail($item['item_id']);
                $itemStr .= $currentItem->name . ', ';
                $transaction->items()->attach($item['item_id'], [
                    'total_quantity' => $item['quantity'],
                    'total_price' => $item['price'],
                ]);
                $currentItem->stock -= $item['quantity'];
                $currentItem->save();
            }

            return redirect()->route('sellingtransactions.index')->with('status', 'Transaksi penjualan mencakup barang: ' . $itemStr . ' dengan waktu ' . $transaction->date . ' berhasil dibuat.');
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
        $validated = $request->validate([
            'id' => 'required|exists:selling_transactions,id',
            'seller_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|integer|min:0',
            'sub_total' => 'required|integer|min:0',
            'total_count' => 'required|integer|min:0',
            'discount_amount' => 'nullable|integer|min:0',
            'total_amount' => 'required|integer|min:0',
        ]);

        $sellingTransaction = SellingTransaction::findOrFail($validated['id']);
        $items = $validated['items'];
        $transactionItemsPivotTable = $sellingTransaction->items->keyBy('id');

        // Check stock for increased quantity
        foreach ($items as $item) {
            $currentItem = Item::findOrFail($item['item_id']);
            $transactionItem = $transactionItemsPivotTable->get($item['item_id']);
            $oldQty = $transactionItem ? $transactionItem->pivot->total_quantity : 0;
            $qtyDiff = $item['quantity'] - $oldQty;
            if ($qtyDiff > 0 && $currentItem->stock < $qtyDiff) {
                return redirect()->route('sellingtransactions.index')->with('error', 'Transaksi tidak dapat dilakukan, Stok barang ' . $currentItem->name . ' tidak mencukupi untuk transaksi ini.');
            }
        }

        try {
            $sellingTransaction->seller_id = $validated['seller_id'];
            $sellingTransaction->date = $validated['date'];
            $sellingTransaction->discount_amount = $validated['discount_amount'] ?? 0;
            $sellingTransaction->total_amount = $validated['total_amount'];
            $sellingTransaction->sub_total = $validated['sub_total'];
            $sellingTransaction->total_count = $validated['total_count'];
            $sellingTransaction->save();

            // Update stock for all items
            foreach ($transactionItemsPivotTable as $itemId => $item) {
                $currentItem = Item::findOrFail($itemId);
                $currentItem->stock += $item->pivot->total_quantity;
                $currentItem->save();
            }

            $sellingTransaction->items()->detach();

            foreach ($items as $item) {
                $currentItem = Item::findOrFail($item['item_id']);
                $sellingTransaction->items()->attach($item['item_id'], [
                    'total_quantity' => $item['quantity'],
                    'total_price' => $item['price'],
                ]);
                $currentItem->stock -= $item['quantity'];
                $currentItem->save();
            }

            return redirect()->route('sellingtransactions.index')->with('status', 'Transaksi dengan waktu ' . $sellingTransaction->date . ' berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('SellingTransaction update failed', ['error' => $e->getMessage()]);
            return redirect()->route('sellingtransactions.index')->with('error', 'Gagal memperbarui transaksi penjualan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified selling transaction from storage.
     */
    public function destroy(Request $request, $id)
    {
        try {
            $sellingTransaction = SellingTransaction::findOrFail($id);
            $sellingTransaction->items()->detach();
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
            $items = $sellingTransaction->items->keyBy('id');
            foreach ($items as $item) {
                $transactionItems = $items->get($item->id)->pivot;
                $item->stock += $transactionItems->total_quantity;
                $item->save();
            }
            $sellingTransaction->items()->detach();
            $sellingTransaction->delete();
            return redirect()->route('sellingtransactions.index')->with('status', 'Transaksi telah dihapus dan stock barang telah ditambakan kembali');
        } catch (\Exception $e) {
            return redirect()->route('sellingtransactions.index')->with('error', 'Transaksi tidak dapat dihapus, Pesan Error: ' . $e->getMessage());
        }
    }

    /**
     * Show the detail modal via AJAX.
     */
    public function showDetail(Request $request)
    {
        $sellingTransaction = SellingTransaction::with(['seller', 'items'])->find($request->id);
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
        $items = Item::all();

        return response()->json([
            'status' => 'ok',
            'msg' => view('sellingtransaction.create', compact('users', 'items'))->render()
        ], 200);
    }

    /**
     * Show the edit modal via AJAX.
     */
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
}
