<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $table = 'cabangs';

    protected $fillable = [
        'name',
        'city',
        'address',
        'email',
        'phone',
        'pastor',
        'map_latitude',
        'map_longitude',
        'about',
        'image_path',
        'sort_order',
        'is_published',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_published' => 'boolean',
        'map_latitude' => 'float',
        'map_longitude' => 'float',
    ];
}
