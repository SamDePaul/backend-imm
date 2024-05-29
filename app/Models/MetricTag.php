<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetricTag extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'definition',
        'calculation',
        'usage_guidance',
        'social',
        'environmental',
        'section',
        'subsection',
        'level_type',
        'related_metrics_code',
        'metric_level',
        'quantity_type',
        'reporting_format',
    ];
}
