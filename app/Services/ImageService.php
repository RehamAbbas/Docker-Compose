<?php

namespace App\Services;

class ImageService
{
    public static function saveImage($image, string $destinationPath): ?string
    {
        if ($image->isValid()) {
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move($destinationPath, $fileName);
            return $fileName;
        }

        return null;
    }

    public static function deleteImage(string $imagePath): bool
    {
        if (file_exists($imagePath)) {
            return unlink($imagePath);
        }

        return false;
    }
}
