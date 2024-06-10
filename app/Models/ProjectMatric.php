<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMatric extends Model
{
    use HasFactory;

    protected $table = 'project_matrics';

    protected $fillable = [
        'matric_id',
        'project_id',
        'value',
    ];

    // Define the relationship with the Metric model
    public function metric()
    {
        return $this->belongsTo(Metric::class, 'matric_id');
    }

    // Define the relationship with the Project model
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
