<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warta extends Model
{
    protected $table = 'wartas';

    protected $fillable = [
        'title',
        'date',
        'edition',
        'thumbnail_path',
        'pdf_path',
        'is_published',
    ];

    protected $casts = [
        'date' => 'date',
        'is_published' => 'boolean',
    ];
}
