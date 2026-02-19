<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MajelisPeriod extends Model
{
    protected $table = 'majelis_periods';

    protected $fillable = [
        'period',
        'thumbnail_path',
        'gallery_paths',
        'about',
        'service',
    ];

    protected $casts = [
        'gallery_paths' => 'array',
    ];
}
