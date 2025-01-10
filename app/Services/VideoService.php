<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class VideoService
{
    public static function save(UploadedFile $video, $folder = ''): string
    {
        $imageName = time() . '.' . strtolower($video->getClientOriginalExtension());
        return $video->storeAs($folder, $imageName, 'public');
    }
}
