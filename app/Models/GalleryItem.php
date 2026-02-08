<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'caption',
        'image_path',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
