<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class MajelisMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'role',
        'period',
        'photo_path',
        'excerpt',
        'about',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public static function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
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

    protected static function booted(): void
    {
        static::saving(function (self $model) {
            if (blank($model->slug) && filled($model->name)) {
                $model->slug = static::uniqueSlug($model->name, $model->id ?: null);
            }
        });
    }
}
