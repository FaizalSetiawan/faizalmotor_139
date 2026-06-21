<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;

class CacheVersion
{
    public const HOME = 'home';
    public const CATALOG = 'catalog';
    public const SIRENS = 'sirens';
    public const MODELS = 'models';

    public static function get(string $segment): int
    {
        $key = static::key($segment);

        return (int) Cache::rememberForever($key, fn () => 1);
    }

    public static function bump(string ...$segments): void
    {
        foreach (array_unique($segments) as $segment) {
            $key = static::key($segment);
            Cache::forever($key, static::get($segment) + 1);
        }
    }

    private static function key(string $segment): string
    {
        return 'cache-version:'.$segment;
    }
}
