<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Storage;

class FileUploadController extends Controller
{
    public function imageUpload()
    {
        $files = request()->file('file');

        $storedFiles = [];

        /** @var UploadedFile $file */
        foreach ($files as $file) {
            $name = str_random(64);
            $extension = $file->getClientOriginalExtension();
            Storage::putFileAs('public/images', $file, "{$name}.{$extension}");
            $storedFile = url("storage/images/{$name}.{$extension}");

            $storedFiles[] = [
                'url' => $storedFile,
                'size' => $file->getSize(),
            ];
        }

        return $this->ok($storedFiles);
    }
}
