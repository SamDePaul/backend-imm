<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'order', 'level', 'parent_indicator_id', 'description', 'sdg_id'];

    public function sdg()
    {
        return $this->belongsTo(Sdg::class);
    }

    public function parent()
    {
        return $this->belongsTo(Indicator::class, 'parent_indicator_id');
    }
}

