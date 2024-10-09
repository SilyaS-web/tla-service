<?php

namespace App\Services;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class ImageService
{
    public static function makeCompressedCopies(UploadedFile $image, $folder = '', $format = 'webp') {
        $urls = [];

        $image_1x = Image::make($image->getRealPath());
        $image_1x->encode($format);
        $urls[] = self::saveCompressedImage($image_1x, $folder . '1x/');

        $image_2x = self::compressImage($image, 440, 540, $format);
        $urls[] = self::saveCompressedImage($image_2x, $folder . '2x/');

        return $urls;
    }


    public static function saveCompressedImage(\Intervention\Image\Image $image, $folder = ''): string
    {
        $imageName = time() . '.' . 'webp';
        $image_path = public_path($folder) . $imageName;

        if (!file_exists($image_path)) {
            Storage::disk('local')->makeDirectory($image_path);
        }

        $image->save($image_path);
        return $image_path;
    }

    public static function compressImage(UploadedFile $image, int $height = 400, int $width = 400, string $format = 'webp'): \Intervention\Image\Image
    {
        $img = Image::make($image->getRealPath());
        $img->resize($height, $width);
        $img->encode($format);

        return $img;
    }
}
