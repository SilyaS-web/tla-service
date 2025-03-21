<?php

namespace App\Services;
use Illuminate\Container\Container;
use Illuminate\Contracts\Filesystem\Factory as FilesystemFactory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageService
{
    public static function makeCompressedCopiesFromFile($image, $folder = '', $format = 'webp') {
        ini_set('memory_limit', '256M');
        $urls = [];

        $image_1x = Image::make($image);
        $image_1x->encode($format);
        $urls[] = self::saveImage($image_1x, $folder . '1x/');

        $image_2x = self::compressImage($image_1x, -1, 540, $format);
        $urls[] = self::saveImage($image_2x, $folder . '2x/');

        return $urls;
    }

    public static function makeCompressedCopies(UploadedFile $image, $folder = '', $format = 'webp'): array
    {
        ini_set('memory_limit', '256M');
        $urls = [];

        $image_1x = Image::make($image->getRealPath());
        $image_1x->encode($format);
        $urls[] = self::saveImage($image_1x, $folder . '1x/');

        $image_2x = self::compressImage($image_1x, -1, 540, $format);
        $urls[] = self::saveImage($image_2x, $folder . '2x/');

        return $urls;
    }

    public static function saveImage(\Intervention\Image\Image $image, $folder = ''): string
    {
        $imageName = Str::random(5) . '_' . time() . '.' . 'webp';
        Storage::put('public/' . $folder . $imageName, $image->encode(), 'public');
        return $folder . $imageName;
    }

    public static function compressImage($img, int $height = 400, int $width = 400, string $format = 'webp'): \Intervention\Image\Image
    {
        ini_set('memory_limit', '256M');
        $old_height = $img->height();
        $old_width = $img->width();

        $k = $old_height / $old_width;

        if ($height === -1) {
            $height = $width / $k;
        } else if ($width === -1) {
            $width = $height * $k;
        }

        $img->resize($height, $width);
        $img->encode($format);

        return $img;
    }
}
