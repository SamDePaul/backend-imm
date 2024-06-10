<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'business_name',
        'survey_title',
        'survey_description',
        'nama_lengkap',
        'email',
        'no_hp',
        'pertanyaan_1',
        'pertanyaan_2',
        'pertanyaan_3',
        'pertanyaan_4',
        'pertanyaan_5'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
