<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorDailyStat extends Model
{
    use HasFactory;

    protected $table = 'visitor_daily_stats';

    protected $fillable = [
        'visit_date',
        'visitor_count',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'visitor_count' => 'integer',
    ];
}
