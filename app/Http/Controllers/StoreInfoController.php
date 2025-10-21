<?php

namespace App\Http\Controllers;

use App\Models\StoreInfo;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class StoreInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoreInfo  $storeInfo
     * @return \Illuminate\Http\Response
     */
    public function show(StoreInfo $storeInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StoreInfo  $storeInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreInfo $storeInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StoreInfo  $storeInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileUploadService $fileUpload)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'address_description' => 'nullable|string',
                'address' => 'required|string|max:255',
                'banner' => 'nullable|image|max:2048',
                'logo' => 'nullable|image|max:2048',
                'home_image' => 'nullable|image|max:2048',
                'storefront_image' => 'nullable|image|max:2048',
                'map_image' => 'nullable|image|max:2048',
                'navbar_color' => 'nullable|string|max:7',
                'bottom_bar_color' => 'nullable|string|max:7',
                'text_color' => 'nullable|string|max:7',
                'text_secondary_color' => 'nullable|string|max:7',
                'phone' => 'nullable|string|max:255',
                'whatsapp' => 'nullable|string|max:255',
            ]);

            $storeInfo = StoreInfo::first();

            if ($request->hasFile('logo')) {
                $validated['logo'] = $fileUpload->uploadFile(
                    $request->file('logo'),
                    $validated['name'] ?? $storeInfo->name,
                    'store_logo'
                );
            }

            if ($request->hasFile('banner')) {
                $validated['banner'] = $fileUpload->uploadFile(
                    $request->file('banner'),
                    $validated['name'] ?? $storeInfo->name,
                    'store_banner'
                );
            }

            if ($request->hasFile('home_image')) {
                $validated['home_image'] = $fileUpload->uploadFile(
                    $request->file('home_image'),
                    $validated['name'] ?? $storeInfo->name,
                    'store_home'
                );
            }

            if ($request->hasFile('storefront_image')) {
                $validated['storefront_image'] = $fileUpload->uploadFile(
                    $request->file('storefront_image'),
                    $validated['name'] ?? $storeInfo->name,
                    'store_front'
                );
            }

            if ($request->hasFile('map_image')) {
                $validated['map_image'] = $fileUpload->uploadFile(
                    $request->file('map_image'),
                    $validated['name'] ?? $storeInfo->name,
                    'store_map'
                );
            }

            $storeInfo->update($validated);

            return back()->with('status', 'Informasi toko berhasil diperbarui.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('StoreInfo update failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Gagal memperbarui informasi toko: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreInfo  $storeInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreInfo $storeInfo)
    {
        //
    }
}
