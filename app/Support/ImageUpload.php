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
        int $quality = 82,
        ?int $maxWidth = null,
        ?int $maxHeight = null
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
        $image = self::resizeImageResource($image, $maxWidth, $maxHeight);

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

    private static function resizeImageResource(mixed $image, ?int $maxWidth, ?int $maxHeight): mixed
    {
        if (!is_resource($image) && !($image instanceof \GdImage)) {
            return $image;
        }

        $width = imagesx($image);
        $height = imagesy($image);

        if ($width < 1 || $height < 1) {
            return $image;
        }

        $targetWidth = $width;
        $targetHeight = $height;

        if ($maxWidth !== null && $width > $maxWidth) {
            $ratio = $maxWidth / $width;
            $targetWidth = $maxWidth;
            $targetHeight = (int) max(1, round($height * $ratio));
        }

        if ($maxHeight !== null && $targetHeight > $maxHeight) {
            $ratio = $maxHeight / $targetHeight;
            $targetHeight = $maxHeight;
            $targetWidth = (int) max(1, round($targetWidth * $ratio));
        }

        if ($targetWidth === $width && $targetHeight === $height) {
            return $image;
        }

        $resized = imagecreatetruecolor($targetWidth, $targetHeight);
        if ($resized === false) {
            return $image;
        }

        imagealphablending($resized, false);
        imagesavealpha($resized, true);
        $transparent = imagecolorallocatealpha($resized, 0, 0, 0, 127);
        imagefilledrectangle($resized, 0, 0, $targetWidth, $targetHeight, $transparent);

        $copied = imagecopyresampled(
            $resized,
            $image,
            0,
            0,
            0,
            0,
            $targetWidth,
            $targetHeight,
            $width,
            $height
        );

        if (!$copied) {
            imagedestroy($resized);
            return $image;
        }

        imagedestroy($image);

        return $resized;
    }
}
