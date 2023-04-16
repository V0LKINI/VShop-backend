<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImagesService
{
    public static function saveRemoteImage($src, $folder)
    {
        $result = false;

        try {
            $name = Str::afterLast($src, '/');
            $name = Str::before($name, '?');
            $path = $folder . '/' . $name;

            $contents = file_get_contents($src);

            $result = Storage::disk('public')->put($path, $contents);
        } catch (\Exception $e) {

        }

        return $result ? $path : false;
    }

    public static function cropRemoteImage($url, $folder, $width, $height, $x0, $y0)
    {
        $name = Str::afterLast($url, '/');
        $name = Str::before($name, '?');
        $path = $folder . '/' . $name;

        $img = Image::make($url);
        $img->crop($width, $height, $x0, $y0);
        $img->save($_SERVER['DOCUMENT_ROOT'] . '/storage/' . $path);

        return $path;
    }
}
