<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display list resources
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index', ['data' => $categories]);
    }

    /**
     * Show form create new resources
     */
    public function create()
    {

    }

    /**
     * Store new create resources
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        try {
            $category = Category::create($validated);
            return redirect()->route('categories.index')->with('status', 'Kategori dengan nama: ' . $category->name . ' berhasil dibuat');
        } catch (\Exception $e) {
            Log::error('Category store failed', ['error' => $e->getMessage()]);
            return redirect()->route('categories.index')->with('error', 'Gagal membuat kategori: ' . $e->getMessage());
        }
    }

    /**
     * Show edit resources
     */
    public function edit(Category $category)
    {

    }

    /**
     * Update resources
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        try {
            $category->update($validated);
            return redirect()->route('categories.index')->with('status', 'Kategori dengan nama: ' . $category->name . ' berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Category update failed', ['error' => $e->getMessage()]);
            return redirect()->route('categories.index')->with('error', 'Gagal memperbarui kategori: ' . $e->getMessage());
        }
    }

    /**
     * Remove resources
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('categories.index')->with('status', 'Kategori telah dihapus');
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect()->route('categories.index')->with('error', 'Maaf anda tidak dapat menghapus kategori ' . $category->name . ' karena telah digunakan di item');
            }
            Log::error('Category delete failed', ['error' => $e->getMessage()]);
            return redirect()->route('categories.index')->with('error', 'Kategori tidak dapat dihapus, Pesan Error: ' . $e->getMessage());
        }
    }

    public function showCreate(Request $request)
    {
        return response()->json([
            'status' => 'ok',
            'msg' => view('category.create')->render()
        ], 200);
    }

    public function showEdit(Request $request)
    {
        $category = Category::findOrFail($request->input('id'));
        return response()->json([
            'status' => 'ok',
            'msg' => view('category.edit', compact('category'))->render()
        ], 200);
    }
}
