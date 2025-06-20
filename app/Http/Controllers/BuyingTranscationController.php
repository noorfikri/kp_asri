<?php

namespace App\Http\Controllers;

use App\Models\BuyingTransaction;
use App\Models\BuyingTransactionItem;
use App\Models\Item;
use App\Models\ItemStock;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BuyingTranscationController extends Controller
{
    /**
     * Display a listing of the buying transactions.
     */
    public function index()
    {
        $buyingTransactions = BuyingTransaction::with(['supplier'])->get();
        return view('buyingtransaction.index', compact('buyingTransactions'))->with('data', $buyingTransactions);
    }

    /**
     * Show the form for creating a new buying transaction.
     */
    public function create()
    {
        // Not used, handled via AJAX modal
    }

    /**
     * Store a newly created buying transaction in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.items_stock_id' => 'required|exists:items_stock,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|integer|min:0',
            'sub_total' => 'required|integer|min:0',
            'total_count' => 'required|integer|min:0',
            'discount_amount' => 'nullable|integer|min:0',
            'other_cost' => 'nullable|integer|min:0',
            'total_amount' => 'required|integer|min:0',
        ]);

        try {
            $transaction = new BuyingTransaction();
            $transaction->supplier_id = $validated['supplier_id'];
            $transaction->date = $validated['date'];
            $transaction->sub_total = $validated['sub_total'];
            $transaction->total_count = $validated['total_count'];
            $transaction->discount_amount = $validated['discount_amount'] ?? 0;
            $transaction->other_cost = $validated['other_cost'] ?? 0;
            $transaction->total_amount = $validated['total_amount'];
            $transaction->save();

            foreach ($validated['items'] as $item) {
                BuyingTransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'items_stock_id' => $item['items_stock_id'],
                    'total_quantity' => $item['quantity'],
                    'total_price' => $item['price'],
                ]);
                // Update items_stock
                $stock = ItemStock::find($item['items_stock_id']);
                $stock->stock += $item['quantity'];
                $stock->save();
            }

            return redirect()->route('buyingtransactions.index')->with('status', 'Transaksi pembelian berhasil dibuat.');
        } catch (\Exception $e) {
            Log::error('BuyingTransaction store failed', ['error' => $e->getMessage()]);
            return redirect()->route('buyingtransactions.index')->with('error', 'Gagal membuat transaksi pembelian: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified buying transaction.
     */
    public function show(BuyingTransaction $buyingTransaction)
    {
        // Not used, handled via AJAX modal
    }

    /**
     * Show the form for editing the specified buying transaction.
     */
    public function edit(BuyingTransaction $buyingTransaction)
    {
        // Not used, handled via AJAX modal
    }

    /**
     * Update the specified buying transaction in storage.
     */
    public function update(Request $request, BuyingTransaction $buyingTransaction)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.items_stock_id' => 'required|exists:items_stock,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|integer|min:0',
            'sub_total' => 'required|integer|min:0',
            'total_count' => 'required|integer|min:0',
            'discount_amount' => 'nullable|integer|min:0',
            'other_cost' => 'nullable|integer|min:0',
            'total_amount' => 'required|integer|min:0',
        ]);

        try {
            // Restore stock before updating
            foreach ($buyingTransaction->itemsStocks as $itemStock) {
                $pivot = $itemStock->pivot;
                $itemStock->stock -= $pivot->total_quantity;
                $itemStock->save();
            }
            $buyingTransaction->itemsStocks()->detach();

            $buyingTransaction->supplier_id = $validated['supplier_id'];
            $buyingTransaction->date = $validated['date'];
            $buyingTransaction->sub_total = $validated['sub_total'];
            $buyingTransaction->total_count = $validated['total_count'];
            $buyingTransaction->discount_amount = $validated['discount_amount'] ?? 0;
            $buyingTransaction->other_cost = $validated['other_cost'] ?? 0;
            $buyingTransaction->total_amount = $validated['total_amount'];
            $buyingTransaction->save();

            foreach ($validated['items'] as $item) {
                BuyingTransactionItem::create([
                    'transaction_id' => $buyingTransaction->id,
                    'items_stock_id' => $item['items_stock_id'],
                    'total_quantity' => $item['quantity'],
                    'total_price' => $item['price'],
                ]);
                $stock = ItemStock::find($item['items_stock_id']);
                $stock->stock += $item['quantity'];
                $stock->save();
            }

            return redirect()->route('buyingtransactions.index')->with('status', 'Transaksi pembelian berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('BuyingTransaction update failed', ['error' => $e->getMessage()]);
            return redirect()->route('buyingtransactions.index')->with('error', 'Gagal memperbarui transaksi pembelian: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified buying transaction from storage.
     */
    public function destroy(BuyingTransaction $buyingTransaction)
    {
        try {
            // Restore stock before deleting
            foreach ($buyingTransaction->itemsStocks as $itemStock) {
                $pivot = $itemStock->pivot;
                $itemStock->stock -= $pivot->total_quantity;
                $itemStock->save();
            }
            $buyingTransaction->itemsStocks()->detach();
            $buyingTransaction->delete();

            return redirect()->route('buyingtransactions.index')->with('status', 'Transaksi telah dihapus');
        } catch (\Exception $e) {
            Log::error('BuyingTransaction delete failed', ['error' => $e->getMessage()]);
            return redirect()->route('buyingtransactions.index')->with('error', 'Transaksi tidak dapat dihapus, Pesan Error: ' . $e->getMessage());
        }
    }

    /**
     * Show the detail modal via AJAX.
     */
    public function showDetail(Request $request)
    {
        $buyingTransaction = BuyingTransaction::with(['supplier', 'items'])->find($request->id);
        return response()->json([
            'status' => 'ok',
            'msg' => view('buyingtransaction.show', compact('buyingTransaction'))->render()
        ], 200);
    }

    /**
     * Show the create modal via AJAX.
     */
    public function showCreate(Request $request)
    {
        $suppliers = Supplier::all();
        $itemsStock = ItemStock::with(['item', 'size', 'colour'])->get();

        return response()->json([
            'status' => 'ok',
            'msg' => view('buyingtransaction.create', compact('itemStock', 'suppliers'))->render()
        ], 200);
    }
}
