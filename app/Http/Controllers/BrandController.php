<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    /**
     * Display a listing of the brands.
     */
    public function index()
    {
        $data = Brand::all();
        return view('brand.index', compact('data'));
    }

    /**
     * Show the form for creating a new brand.
     */
    public function create()
    {
        return view('brand.create');
    }

    /**
     * Store a newly created brand in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
        ]);

        $brand = Brand::create($validated);

        return redirect()
            ->route('brands.index')
            ->with('status', "Brand dengan nama: {$brand->name} berhasil dibuat");
    }

    /**
     * Show the form for editing the specified brand.
     */
    public function edit(Brand $brand)
    {
        return view('brand.edit', compact('brand'));
    }

    /**
     * Update the specified brand in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
        ]);

        $brand->update($validated);

        return redirect()
            ->route('brands.index')
            ->with('status', "Brand dengan nama: {$brand->name} berhasil diperbarui");
    }

    /**
     * Remove the specified brand from storage.
     */
    public function destroy(Brand $brand)
    {
        try {
            $brand->delete();
            return redirect()
                ->route('brands.index')
                ->with('status', 'Brand telah dihapus');
        } catch (\Exception $e) {
            Log::error('Brand deletion failed', ['error' => $e->getMessage()]);
            return redirect()
                ->route('brands.index')
                ->with('error', 'Brand tidak dapat dihapus. Pesan Error: ' . $e->getMessage());
        }
    }

    /**
     * Show the create modal via AJAX.
     */
    public function showCreate(Request $request)
    {
        return response()->json([
            'status' => 'ok',
            'msg' => view('brand.create')->render(),
        ]);
    }

    /**
     * Show the edit modal via AJAX.
     */
    public function showEdit(Request $request)
    {
        $brand = Brand::findOrFail($request->input('id'));

        return response()->json([
            'status' => 'ok',
            'msg' => view('brand.edit', compact('brand'))->render(),
        ]);
    }
}
