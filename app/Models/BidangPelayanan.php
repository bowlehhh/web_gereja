<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BidangPelayanan extends Model
{
    protected $table = 'bidang_pelayanans';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'service_year',
        'member_photo_paths',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'service_year' => 'integer',
        'member_photo_paths' => 'array',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public static function uniqueSlug(string $source, ?int $ignoreId = null): string
    {
        $base = Str::slug($source);
        $slug = $base !== '' ? $base : Str::random(8);

        $i = 2;
        while (static::query()
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()
        ) {
            $slug = $base !== '' ? $base.'-'.$i : Str::random(8);
            $i++;
        }

        return $slug;
    }
}
