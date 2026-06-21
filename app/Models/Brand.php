<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\CacheVersion;

class Brand extends Model
{
    protected $fillable = ['name'];

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

    public function models()
    {
        return $this->hasMany(MotorModel::class);
    }
}
