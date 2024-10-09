<?php

namespace App\Services;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
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
        $urls[] = self::saveCompressedImage($image_1x, $folder . '1x/');

        $image_2x = self::compressImage($image, 440, 540, $format);
        $urls[] = self::saveCompressedImage($image_2x, $folder . '2x/');

        return $urls;
    }


    /**
     * @throws BindingResolutionException
     */
    public static function saveCompressedImage(\Intervention\Image\Image $image, $folder = ''): string
    {
        $imageName = time() . '.' . 'webp';
        $image_path = $folder . $imageName;

        return Container::getInstance()->make(FilesystemFactory::class)->disk('public')->put(
            $image_path, $image->encode(), []
        );
    }

    public static function compressImage(UploadedFile $image, int $height = 400, int $width = 400, string $format = 'webp'): \Intervention\Image\Image
    {
        $img = Image::make($image->getRealPath());
        $img->resize($height, $width);
        $img->encode($format);

        return $img;
    }
}
