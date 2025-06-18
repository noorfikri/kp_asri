<?php

namespace App\Http\Controllers;

use App\Models\BuyingTransaction;
use App\Models\Item;
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
        $items = Item::all();
        $buyingTransactions = BuyingTransaction::all();
        return view('buyingtransaction.index', compact('buyingTransactions', 'items'))->with('data', $buyingTransactions);
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
            'items.*.item_id' => 'required|exists:items,id',
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
                $transaction->items()->attach($item['item_id'], [
                    'total_quantity' => $item['quantity'],
                    'total_price' => $item['price'],
                ]);
                // Update item stock
                $currentItem = Item::find($item['item_id']);
                if ($currentItem) {
                    $currentItem->stock += $item['quantity'];
                    $currentItem->save();
                }
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
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|integer|min:0',
            'sub_total' => 'required|integer|min:0',
            'total_count' => 'required|integer|min:0',
            'discount_amount' => 'nullable|integer|min:0',
            'other_cost' => 'nullable|integer|min:0',
            'total_amount' => 'required|integer|min:0',
        ]);

        try {
            $buyingTransaction->supplier_id = $validated['supplier_id'];
            $buyingTransaction->date = $validated['date'];
            $buyingTransaction->sub_total = $validated['sub_total'];
            $buyingTransaction->total_count = $validated['total_count'];
            $buyingTransaction->discount_amount = $validated['discount_amount'] ?? 0;
            $buyingTransaction->other_cost = $validated['other_cost'] ?? 0;
            $buyingTransaction->total_amount = $validated['total_amount'];
            $buyingTransaction->save();

            // Detach old items and update stock
            foreach ($buyingTransaction->items as $item) {
                $item->stock -= $item->pivot->total_quantity;
                $item->save();
            }
            $buyingTransaction->items()->detach();

            // Attach new items and update stock
            foreach ($validated['items'] as $item) {
                $buyingTransaction->items()->attach($item['item_id'], [
                    'total_quantity' => $item['quantity'],
                    'total_price' => $item['price'],
                ]);
                $currentItem = Item::find($item['item_id']);
                if ($currentItem) {
                    $currentItem->stock += $item['quantity'];
                    $currentItem->save();
                }
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
            foreach ($buyingTransaction->items as $item) {
                $item->stock -= $item->pivot->total_quantity;
                $item->save();
            }
            $buyingTransaction->items()->detach();
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
        $items = Item::all();

        return response()->json([
            'status' => 'ok',
            'msg' => view('buyingtransaction.create', compact('items', 'suppliers'))->render()
        ], 200);
    }
}
