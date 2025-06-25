<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the suppliers.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.index', ['data' => $suppliers]);
    }

    /**
     * Show the form for creating a new supplier.
     */
    public function create()
    {
        // Not used, handled via AJAX modal
    }

    /**
     * Store a newly created supplier in storage.
     */
    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|max:255|unique:suppliers,name',
            'address' => 'required|string|max:255',
            'telephone' => 'required|string|max:50',
            'picture' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('suppliers.index')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $supplier = new Supplier();
            $supplier->name = request('name');
            $supplier->address = request('address');
            $supplier->telephone = request('telephone');

            if (request()->hasFile('picture')) {
                $supplier->picture = App::call([new FileUploadService, 'uploadFile'], [
                    'file' => request()->file('picture'),
                    'filename' => $supplier->name,
                    'folder' => 'supplier'
                ]);
            }

            $supplier->save();

            return redirect()->route('suppliers.index')->with('status', 'Supplier dengan nama: ' . $supplier->name . ' berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()->route('suppliers.index')->with('error', 'Gagal membuat supplier: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified supplier.
     */
    public function edit(Supplier $supplier)
    {
        // Not used, handled via AJAX modal
    }

    /**
     * Update the specified supplier in storage.
     */
    public function update(Supplier $supplier)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|max:255|unique:suppliers,name,' . $supplier->id,
            'address' => 'required|string|max:255',
            'telephone' => 'required|string|max:50',
            'picture' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('suppliers.index')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $supplier->name = request('name');
            $supplier->address = request('address');
            $supplier->telephone = request('telephone');

            if (request()->hasFile('picture')) {
                $supplier->picture = App::call([new FileUploadService, 'uploadFile'], [
                    'file' => request()->file('picture'),
                    'filename' => $supplier->name,
                    'folder' => 'supplier'
                ]);
            }

            $supplier->save();

            return redirect()->route('suppliers.index')->with('status', 'Supplier dengan nama: ' . $supplier->name . ' berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('suppliers.index')->with('error', 'Gagal memperbarui supplier: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified supplier from storage.
     */
    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();
            return redirect()->route('suppliers.index')->with('status', 'Supplier telah dihapus');
        } catch (\Exception $e) {
            return redirect()->route('suppliers.index')->with('error', 'Supplier tidak dapat dihapus, Pesan Error: ' . $e->getMessage());
        }
    }

    /**
     * Show the detail modal via AJAX.
     */
    public function showDetail()
    {
        $data = Supplier::find(request('id'));
        return response()->json([
            'status' => 'ok',
            'msg' => view('supplier.show', compact('data'))->render()
        ], 200);
    }

    /**
     * Show the create modal via AJAX.
     */
    public function showCreate()
    {
        return response()->json([
            'status' => 'ok',
            'msg' => view('supplier.create')->render()
        ], 200);
    }

    /**
     * Show the edit modal via AJAX.
     */
    public function showEdit()
    {
        $supplier = Supplier::find(request('id'));
        return response()->json([
            'status' => 'ok',
            'msg' => view('supplier.edit', ['supplier' => $supplier])->render()
        ], 200);
    }
}
