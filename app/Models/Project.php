<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tag_id',
        'judul',
        'deskripsi',
        'tujuan',
        'targetPelanggan',
        'tanggalMulai',
        'tanggalSelesai',
        'negara_id',
        'provinsi_id',
        'kota_id',
        'data_path',
        'kategori',
        'dana',
        'jenis_dana',
        'dana_lain',
        'sdg_id',
        'indikator_id',
        'matrik_id',
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'negara_id');
    }

    public function sdg()
    {
        return $this->belongsTo(Sdg::class);
    }

    public function index()
    {
        $projects = Project::with('country')->get(); // Pastikan memuat relasi country
        return view('projects.index', compact('projects'));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the ProjectMetrics model
    public function projectMatrics()
    {
        return $this->hasMany(ProjectMatrics::class, 'project_id');
    }
}

