<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\CacheVersion;

class Sirine extends Model
{
    protected $fillable = [
        'name',
        'image',
        'gallery_images',
        'gallery_videos',
        'description',
        'english_description',
        'price',
        'shopee_url',
        'tiktokshop_url',
        'tokopedia_url',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'gallery_videos' => 'array',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => CacheVersion::bump(
            CacheVersion::HOME,
            CacheVersion::SIRENS
        ));

        static::deleted(fn () => CacheVersion::bump(
            CacheVersion::HOME,
            CacheVersion::SIRENS
        ));
    }
}
