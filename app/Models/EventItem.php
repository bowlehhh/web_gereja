<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventItem extends Model
{
    use HasFactory;

    protected $table = 'event_items';

    protected $fillable = [
        'title',
        'description',
        'content',
        'start_date',
        'end_date',
        'location',
        'thumbnail_path',
        'photo_path',
        'video_path',
        'youtube_url',
        'is_published',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_published' => 'boolean',
    ];
}
