<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Colour;
use App\Models\Category;
use App\Models\ItemStock;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UpdateItemRequest;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ItemController extends Controller
{
    /**
     * Display a listing of resources.
     */
    public function index()
    {
        $category = Category::all();
        $size = Size::all();
        $colour = Colour::all();
        $brand = Brand::all();
        $items = Item::all();

        return view('item.index', [
            'data' => $items,
            'category' => $category,
            'size' => $size,
            'colour' => $colour,
            'brand' => $brand
        ]);
    }

    /**
     * Show the form for creating a new resources.
     */
    public function create()
    {
        $this->authorize('create', Item::class);
        $category = Category::all();
        $size = Size::all();
        $colour = Colour::all();
        $brand = Brand::all();

        return view('item.create', [
            'category' => $category,
            'size' => $size,
            'colour' => $colour,
            'brand' => $brand
        ]);
    }

    /**
     * Store a newly created resources.
     */
    public function store(Request $request, FileUploadService $fileUpload)
    {
        $this->authorize('create', Item::class);

        $validationRules = [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ];

        $validationRules['stocks'] = 'sometimes|array|min:1';
        $validationRules['stocks.*.size_id'] = 'required|exists:sizes,id';
        $validationRules['stocks.*.colour_id'] = 'required|exists:colours,id';

        if (auth()->user()->can('updateStock', Item::class)) {
            $validationRules['stocks.*.stock'] = 'required|integer|min:0';
        }

        $validated = $request->validate($validationRules);

        try {
            $item = new Item();
            $item->name = $validated['name'];
            $item->category_id = $validated['category_id'];
            $item->brand_id = $validated['brand_id'] ?? null;
            $item->price = $validated['price'];
            $item->description = $validated['description'] ?? null;
            $item->note = $validated['note'] ?? null;

            if ($request->hasFile('image')) {
                $item->image = App::call([$fileUpload, 'uploadFile'], [
                    'file' => $request->file('image'),
                    'filename' => $item->name,
                    'folder' => 'item'
                ]);
            }

            $item->save();

            if ($request->has('stocks')) {
                $stocks = $request->input('stocks');
                foreach ($stocks as &$stockCombo) {
                    if (auth()->user()->cannot('updateStock', Item::class)) {
                        $stockCombo['stock'] = 0;
                    }
                }
                $item->stocks()->createMany($stocks);
            }

            return redirect()->route('items.index')->with('status', 'Barang dengan nama: ' . $item->name . ' berhasil dibuat');
        } catch (\Exception $e) {
            Log::error('Item store failed', ['error' => $e->getMessage()]);
            return redirect()->route('items.index')->with('error', 'Gagal membuat barang: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resources.
     */
    public function show(Item $item)
    {
        return view('item.show', ['data' => $item]);
    }

    /**
     * Show the form for editing the specified resources.
     */
    public function edit(Request $request)
    {
        $item = Item::find($request->input('id'));
        $this->authorize('update', $item);
        $category = Category::all();
        $size = Size::all();
        $colour = Colour::all();
        $brand = Brand::all();

        return response()->json([
            'status' => 'ok',
            'msg' => view('item.edit', [
                'item' => $item,
                'category' => $category,
                'size' => $size,
                'colour' => $colour,
                'brand' => $brand
            ])->render()
        ], 200);
    }

    /**
     * Update the specified resources.
     */
    public function update(Request $request, Item $item, FileUploadService $fileUpload)
    {
        $this->authorize('update', $item);

        $validationRules = [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ];

if (auth()->user()->can('updateStock', $item)) {
            $validationRules['stocks'] = 'required|array|min:1';
            $validationRules['stocks.*.size_id'] = 'required|exists:sizes,id';
            $validationRules['stocks.*.colour_id'] = 'required|exists:colours,id';
            $validationRules['stocks.*.stock'] = 'required|integer|min:0';
        } else {
            $validationRules['stocks'] = 'sometimes|array';
            $validationRules['stocks.*.size_id'] = 'sometimes|required|exists:sizes,id';
            $validationRules['stocks.*.colour_id'] = 'sometimes|required|exists:colours,id';
        }

        $validated = $request->validate($validationRules);

        try {
            $item->name = $validated['name'];
            $item->category_id = $validated['category_id'];
            $item->brand_id = $validated['brand_id'] ?? null;
            $item->price = $validated['price'];
            $item->description = $validated['description'] ?? null;
            $item->note = $validated['note'] ?? null;

            if ($request->hasFile('image')) {
                $item->image = App::call([$fileUpload, 'uploadFile'], [
                    'file' => $request->file('image'),
                    'filename' => $item->name,
                    'folder' => 'item'
                ]);
            }

            $item->save();

            if ($request->has('stocks')) {
                $stocks = $request->input('stocks');
                if (auth()->user()->can('updateStock', $item)) {
                    $item->stocks()->delete();
                    $item->stocks()->createMany($stocks);
                } else {
                    foreach ($stocks as $stockCombo) {
                        if (isset($stockCombo['size_id']) && isset($stockCombo['colour_id'])) {
                            ItemStock::updateOrCreate(
                                [
                                    'item_id' => $item->id,
                                    'size_id' => $stockCombo['size_id'],
                                    'colour_id' => $stockCombo['colour_id'],
                                ],
                                ['stock' => 0]
                            );
                        }
                    }
                }
            }

            return redirect()->route('items.index')->with('status', 'Barang dengan nama: ' . $item->name . ' berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Item update failed', ['error' => $e->getMessage()]);
            return redirect()->route('items.index')->with('error', 'Gagal memperbarui barang: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resources.
     */
    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);
        $relations = [];
        $itemStocks = $item->stocks;
        $usedInBuying = false;
        $usedInSelling = false;
        foreach ($itemStocks as $stock) {
            if ($stock->buyingTransactionItems()->exists()) {
                $usedInBuying = true;
            }
            if ($stock->sellingTransactionItems()->exists()) {
                $usedInSelling = true;
            }
        }
        if ($usedInBuying) {
            $relations[] = 'transaksi pembelian';
        }
        if ($usedInSelling) {
            $relations[] = 'transaksi penjualan';
        }
        if (count($relations) > 0) {
            $relationStr = implode(', ', $relations);
            return redirect()->route('items.index')->with('error', 'Maaf anda tidak dapat menghapus ' . $item->name . ' karena telah digunakan di ' . $relationStr);
        }
        try {
            $item->stocks()->delete();
            $item->delete();
            return redirect()->route('items.index')->with('status', 'Barang telah dihapus');
        } catch (QueryException $e) {
            return redirect()->route('items.index')->with('error', 'Barang tidak dapat dihapus, Pesan Error: ' . $e->getMessage());
        }
    }

    public function showDetail(Request $request)
    {
        $item = Item::find($request->input('id'));
        return response()->json([
            'status' => 'ok',
            'msg' => view('item.show', ['data' => $item])->render()
        ], 200);
    }

    public function showCreate(Request $request)
    {
        $this->authorize('create', Item::class);
        $category = Category::all();
        $size = Size::all();
        $colour = Colour::all();
        $brand = Brand::all();

        return response()->json([
            'status' => 'ok',
            'msg' => view('item.create', [
                'category' => $category,
                'size' => $size,
                'colour' => $colour,
                'brand' => $brand
            ])->render()
        ], 200);
    }

    public function showEdit(Request $request)
    {
        $item = Item::find($request->input('id'));
        $this->authorize('update', $item);
        $category = Category::all();
        $size = Size::all();
        $colour = Colour::all();
        $brand = Brand::all();

        return response()->json([
            'status' => 'ok',
            'msg' => view('item.edit', [
                'item' => $item,
                'category' => $category,
                'size' => $size,
                'colour' => $colour,
                'brand' => $brand
            ])->render()
        ], 200);
    }

    public function gallery()
    {
        $items = Item::with(['stocks.size', 'stocks.colour'])->get();
        return view('homepage.gallery', ['items' => $items]);
    }
}
