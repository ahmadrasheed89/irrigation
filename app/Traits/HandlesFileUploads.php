<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HandlesFileUploads
{
    public function uploadMultipleFiles(array $files, string $folder): array
    {
        $paths = [];
        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $paths[] = $file->store($folder, 'public');
            }
        }
        return $paths;
    }

    public function storeFile($file, string $folder): ?string
    {
        if (!$file) return null;
        return $file->store($folder, 'public');
    }
}
