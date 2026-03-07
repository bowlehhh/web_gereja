<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RenunganItem extends Model
{
    use HasFactory;

    protected $table = 'renungan_items';

    protected $fillable = [
        'title',
        'slug',
        'scripture_reference',
        'author',
        'excerpt',
        'content',
        'image_path',
        'published_at',
        'sort_order',
        'is_published',
    ];

    protected $casts = [
        'published_at' => 'date',
        'sort_order' => 'integer',
        'is_published' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public static function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base !== '' ? $base : Str::random(8);

        $i = 2;
        while (static::query()
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()
        ) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }
}

