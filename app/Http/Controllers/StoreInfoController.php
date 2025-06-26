<?php

namespace App\Http\Controllers;

use App\Models\StoreInfo;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

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
    public function update(Request $request, StoreInfo $storeInfo, FileUploadService $fileUpload)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'banner' => 'nullable|image|max:2048',
            'logo' => 'nullable|image|max:2048',
            'phone' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
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

        $storeInfo->update($validated);

        return back()->with('status', 'Informasi toko berhasil diperbarui.');
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
