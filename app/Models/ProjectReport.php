<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'report_date',
        'impact_measure',
        'progress_percentage',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
