<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag_id',
        'judul',
        'deskripsi',
        'tujuan',
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
}
