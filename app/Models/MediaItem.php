<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MediaItem extends Model
{
    protected $table = 'media_items';

    protected $fillable = [
        'title',
        'speaker',
        'service_at',
        'youtube_url',
        'youtube_id',
        'thumbnail_path',
        'is_published',
    ];

    protected $casts = [
        'service_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    public static function extractYoutubeId(string $value): ?string
    {
        $value = trim($value);
        if ($value === '') return null;

        // Allow raw ID (common case when copied from embed)
        if (preg_match('~^[a-zA-Z0-9_-]{11}$~', $value)) {
            return $value;
        }

        $parts = @parse_url($value);
        if (!is_array($parts) || empty($parts['host'])) return null;

        $host = strtolower((string) $parts['host']);
        $host = preg_replace('~^www\.~', '', $host);

        $path = (string) ($parts['path'] ?? '');
        $query = (string) ($parts['query'] ?? '');

        if ($host === 'youtu.be') {
            $id = trim($path, '/');
            return $id !== '' ? $id : null;
        }

        if (str_contains($host, 'youtube.com') || str_contains($host, 'youtube-nocookie.com')) {
            // /embed/{id}, /shorts/{id}, /live/{id}, /v/{id}
            if (preg_match('~^/(embed|shorts|live|v)/([^/?#]+)~', $path, $m)) {
                return $m[2] ?? null;
            }

            parse_str($query, $q);
            if (!empty($q['v']) && is_string($q['v'])) {
                return $q['v'];
            }
        }

        return null;
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        if (!empty($this->thumbnail_path)) {
            return Storage::disk('public')->url($this->thumbnail_path);
        }

        if (!empty($this->youtube_id)) {
            return "https://img.youtube.com/vi/{$this->youtube_id}/hqdefault.jpg";
        }

        return null;
    }

    public function getEmbedUrlAttribute(): ?string
    {
        if (empty($this->youtube_id)) return null;
        return "https://www.youtube.com/embed/{$this->youtube_id}";
    }
}
