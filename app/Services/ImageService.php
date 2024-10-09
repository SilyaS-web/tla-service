<?php

namespace App\Services;
use Illuminate\Container\Container;
use Illuminate\Contracts\Filesystem\Factory as FilesystemFactory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class ImageService
{
    public static function makeCompressedCopies(UploadedFile $image, $folder = '', $format = 'webp') {
        $urls = [];

        $image_1x = Image::make($image->getRealPath());
        $image_1x->encode($format);
        $urls[] = self::saveImage($image_1x, $folder . '1x/');

        $image_2x = self::compressImage($image, -1, 540, $format);
        $urls[] = self::saveImage($image_2x, $folder . '2x/');

        return $urls;
    }


    public static function saveImage(\Intervention\Image\Image $image, $folder = ''): string
    {
        $imageName = time() . '.' . 'webp';
        Storage::put('public/' . $folder . $imageName, $image->encode(), 'public');
        return $folder . $imageName;
    }

    public static function compressImage(UploadedFile $image, int $height = 400, int $width = 400, string $format = 'webp'): \Intervention\Image\Image
    {
        $img = Image::make($image->getRealPath());

        $old_height = $img->height();
        $old_width = $img->width();

        $k = $old_height / $old_width;

        if ($height === -1) {
            $height = $width * $k;
        } else if ($width === -1) {
            $width = $height / $k;
        }

        $img->resize($height, $width);
        $img->encode($format);

        return $img;
    }
}
