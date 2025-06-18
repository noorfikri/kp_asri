<?php

namespace App\Http\Controllers;

use App\Models\BuyingTransactionItem;
use App\Models\BuyingTransaction;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BuyingTranscationItemController extends Controller
{
    /**
     * Display a listing of the buying transaction items.
     */
    public function index()
    {
        $items = BuyingTransactionItem::with(['buyingTransaction', 'item'])->get();
        return view('buyingtransactionitem.index', compact('items'));
    }

    /**
     * Show the form for creating a new buying transaction item.
     */
    public function create()
    {
        $transactions = BuyingTransaction::all();
        $items = Item::all();
        return view('buyingtransactionitem.create', compact('transactions', 'items'));
    }

    /**
     * Store a newly created buying transaction item in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_id' => 'required|exists:buying_transactions,id',
            'item_id' => 'required|exists:items,id',
            'total_quantity' => 'required|integer|min:1',
            'total_price' => 'required|integer|min:0',
        ]);

        try {
            $item = BuyingTransactionItem::create($validated);

            // Optionally update item stock
            $itemModel = Item::find($validated['item_id']);
            if ($itemModel) {
                $itemModel->stock += $validated['total_quantity'];
                $itemModel->save();
            }

            return redirect()->route('buyingtransactionitems.index')->with('status', 'Item transaksi pembelian berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('BuyingTransactionItem store failed', ['error' => $e->getMessage()]);
            return redirect()->route('buyingtransactionitems.index')->with('error', 'Gagal menambah item transaksi pembelian: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified buying transaction item.
     */
    public function show(BuyingTransactionItem $buyingTransactionItem)
    {
        return view('buyingtransactionitem.show', compact('buyingTransactionItem'));
    }

    /**
     * Show the form for editing the specified buying transaction item.
     */
    public function edit(BuyingTransactionItem $buyingTransactionItem)
    {
        $transactions = BuyingTransaction::all();
        $items = Item::all();
        return view('buyingtransactionitem.edit', compact('buyingTransactionItem', 'transactions', 'items'));
    }

    /**
     * Update the specified buying transaction item in storage.
     */
    public function update(Request $request, BuyingTransactionItem $buyingTransactionItem)
    {
        $validated = $request->validate([
            'transaction_id' => 'required|exists:buying_transactions,id',
            'item_id' => 'required|exists:items,id',
            'total_quantity' => 'required|integer|min:1',
            'total_price' => 'required|integer|min:0',
        ]);

        try {
            // Optionally update item stock
            $oldQuantity = $buyingTransactionItem->total_quantity;
            $itemModel = Item::find($validated['item_id']);
            if ($itemModel) {
                $itemModel->stock -= $oldQuantity;
                $itemModel->stock += $validated['total_quantity'];
                $itemModel->save();
            }

            $buyingTransactionItem->update($validated);

            return redirect()->route('buyingtransactionitems.index')->with('status', 'Item transaksi pembelian berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('BuyingTransactionItem update failed', ['error' => $e->getMessage()]);
            return redirect()->route('buyingtransactionitems.index')->with('error', 'Gagal memperbarui item transaksi pembelian: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified buying transaction item from storage.
     */
    public function destroy(BuyingTransactionItem $buyingTransactionItem)
    {
        try {
            // Optionally update item stock
            $itemModel = Item::find($buyingTransactionItem->item_id);
            if ($itemModel) {
                $itemModel->stock -= $buyingTransactionItem->total_quantity;
                $itemModel->save();
            }

            $buyingTransactionItem->delete();

            return redirect()->route('buyingtransactionitems.index')->with('status', 'Item transaksi pembelian berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('BuyingTransactionItem delete failed', ['error' => $e->getMessage()]);
            return redirect()->route('buyingtransactionitems.index')->with('error', 'Gagal menghapus item transaksi pembelian: ' . $e->getMessage());
        }
    }
}
