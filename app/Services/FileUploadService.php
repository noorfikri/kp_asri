<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    /**
     * Upload a file to the specified folder and return its storage path.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $filename
     * @param string $folder
     * @return string
     */
    public function uploadFile(UploadedFile $file, string $filename, string $folder): string
    {
        $safeFilename = preg_replace('/[^A-Za-z0-9_\-]/', '_', $filename);
        $safeFolder = preg_replace('/[^A-Za-z0-9_\-]/', '_', $folder);
        $imgFile = $safeFolder . '_' . $safeFilename . '_' . time() . '_' . $file->getClientOriginalName();

        $path = $file->storeAs("public/assets/uploaded/img/{$safeFolder}", $imgFile);

        return Storage::url($path);
    }
}
