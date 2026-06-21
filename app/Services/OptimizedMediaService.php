<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class OptimizedMediaService
{
    public const MAIN_IMAGE_MAX_KB = 2048;
    public const GALLERY_IMAGE_MAX_KB = 2048;
    public const VIDEO_MAX_KB = 20480;
    public const MAX_GALLERY_IMAGES = 8;
    public const MAX_GALLERY_VIDEOS = 2;
    private const MAX_IMAGE_DIMENSION = 1600;
    private const WEBP_QUALITY = 78;

    public function storeOptimizedImage(UploadedFile $file, string $directory): string
    {
        if (! function_exists('imagewebp')) {
            return $file->store($directory, config('filesystems.default'));
        }

        $rawImage = file_get_contents($file->getRealPath());
        $source = $rawImage !== false ? @imagecreatefromstring($rawImage) : false;

        if ($source === false) {
            throw new RuntimeException('Gagal memproses gambar yang diupload.');
        }

        [$width, $height] = $this->resolveImageSize($file);
        [$targetWidth, $targetHeight] = $this->fitDimensions($width, $height);

        $canvas = imagecreatetruecolor($targetWidth, $targetHeight);

        if ($canvas === false) {
            imagedestroy($source);

            throw new RuntimeException('Gagal menyiapkan gambar untuk kompresi.');
        }

        imagepalettetotruecolor($canvas);
        imagealphablending($canvas, false);
        imagesavealpha($canvas, true);

        $transparent = imagecolorallocatealpha($canvas, 0, 0, 0, 127);
        imagefilledrectangle($canvas, 0, 0, $targetWidth, $targetHeight, $transparent);

        imagecopyresampled($canvas, $source, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);

        $tempPath = tempnam(sys_get_temp_dir(), 'fm139_');

        if ($tempPath === false || ! imagewebp($canvas, $tempPath, self::WEBP_QUALITY)) {
            imagedestroy($canvas);
            imagedestroy($source);

            throw new RuntimeException('Gagal menyimpan gambar hasil kompresi.');
        }

        $path = trim($directory, '/').'/'.Str::uuid()->toString().'.webp';
        $stream = fopen($tempPath, 'rb');

        if ($stream === false) {
            @unlink($tempPath);
            imagedestroy($canvas);
            imagedestroy($source);

            throw new RuntimeException('Gagal membaca file gambar hasil kompresi.');
        }

        Storage::disk(config('filesystems.default'))->put($path, $stream);

        fclose($stream);
        @unlink($tempPath);
        imagedestroy($canvas);
        imagedestroy($source);

        return $path;
    }

    public function storeOptimizedImages(array $files, string $directory): array
    {
        return collect($files)
            ->filter()
            ->map(fn (UploadedFile $file) => $this->storeOptimizedImage($file, $directory))
            ->values()
            ->all();
    }

    public function storeVideos(array $files, string $directory): array
    {
        return collect($files)
            ->filter()
            ->map(fn (UploadedFile $file) => $file->store($directory, config('filesystems.default')))
            ->values()
            ->all();
    }

    public function deleteFiles(?array $paths): void
    {
        $disk = config('filesystems.default');
        foreach ($paths ?? [] as $path) {
            Storage::disk($disk)->delete($path);
        }
    }

    private function resolveImageSize(UploadedFile $file): array
    {
        $size = getimagesize($file->getRealPath());

        if (! is_array($size) || count($size) < 2) {
            throw new RuntimeException('Ukuran gambar tidak valid.');
        }

        return [(int) $size[0], (int) $size[1]];
    }

    private function fitDimensions(int $width, int $height): array
    {
        $largestSide = max($width, $height);

        if ($largestSide <= self::MAX_IMAGE_DIMENSION) {
            return [$width, $height];
        }

        $ratio = self::MAX_IMAGE_DIMENSION / $largestSide;

        return [
            max(1, (int) round($width * $ratio)),
            max(1, (int) round($height * $ratio)),
        ];
    }
}
