<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUpload
{
    public static function storeAsWebp(
        UploadedFile $file,
        string $directory,
        string $disk = 'public',
        int $quality = 82
    ): string {
        $directory = trim($directory, '/');

        if (!self::canConvertToWebp($file)) {
            return $file->store($directory, $disk);
        }

        $image = self::createImageResource($file);
        if (!$image) {
            return $file->store($directory, $disk);
        }

        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);

        $filename = Str::uuid()->toString().'.webp';
        $path = $directory !== '' ? $directory.'/'.$filename : $filename;

        $tempPath = tempnam(sys_get_temp_dir(), 'webp_');
        if ($tempPath === false) {
            imagedestroy($image);
            return $file->store($directory, $disk);
        }

        $saved = imagewebp($image, $tempPath, $quality);
        imagedestroy($image);

        if (!$saved) {
            @unlink($tempPath);
            return $file->store($directory, $disk);
        }

        $stream = fopen($tempPath, 'r');
        $stored = $stream && Storage::disk($disk)->put($path, $stream);
        if (is_resource($stream)) {
            fclose($stream);
        }
        @unlink($tempPath);

        if (!$stored) {
            return $file->store($directory, $disk);
        }

        return $path;
    }

    private static function canConvertToWebp(UploadedFile $file): bool
    {
        if (!function_exists('imagewebp')) {
            return false;
        }

        $extension = strtolower($file->getClientOriginalExtension());
        return match ($extension) {
            'jpg', 'jpeg' => function_exists('imagecreatefromjpeg'),
            'png' => function_exists('imagecreatefrompng'),
            'webp' => function_exists('imagecreatefromwebp'),
            default => false,
        };
    }

    private static function createImageResource(UploadedFile $file): mixed
    {
        $path = $file->getPathname();
        $extension = strtolower($file->getClientOriginalExtension());

        return match ($extension) {
            'jpg', 'jpeg' => @imagecreatefromjpeg($path),
            'png' => @imagecreatefrompng($path),
            'webp' => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($path) : false,
            default => false,
        };
    }
}
