<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Support\CacheVersion;

class MotorModel extends Model
{
    protected $fillable = ['brand_id', 'name'];

    protected static function booted(): void
    {
        static::saved(fn () => CacheVersion::bump(
            CacheVersion::CATALOG,
            CacheVersion::MODELS
        ));

        static::deleted(fn () => CacheVersion::bump(
            CacheVersion::CATALOG,
            CacheVersion::MODELS
        ));
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getFamilyNameAttribute(): string
    {
        return static::splitName($this->name)['family'];
    }

    public function getGenerationNameAttribute(): ?string
    {
        return static::splitName($this->name)['generation'];
    }

    public static function splitName(string $name): array
    {
        $cleanName = trim(preg_replace('/\s+/', ' ', $name));
        $parts = preg_split('/[\s\/-]+/', $cleanName, 2, PREG_SPLIT_NO_EMPTY);

        if (empty($parts)) {
            return ['family' => Str::upper($cleanName), 'generation' => null];
        }

        $family = Str::upper($parts[0]);
        $generation = isset($parts[1]) ? trim(Str::upper($parts[1])) : null;

        return [
            'family' => $family,
            'generation' => $generation !== '' ? $generation : null,
        ];
    }
}
