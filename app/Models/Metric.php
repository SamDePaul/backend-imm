<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    use HasFactory;

    protected $fillable = [
        'indicator_order',
        'value'
    ];

    // Define the relationship with the ProjectMatrics model
    public function projectMatrics()
    {
        return $this->hasMany(ProjectMatric::class, 'matric_id');
    }
}
