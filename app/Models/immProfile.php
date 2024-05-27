<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class immProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_perusahaan',
        'profil_perusahaan',
        'email',
        'email_verified_at',
        'negara',
        'provinsi',
        'kota',
        'no_hp',
        'jml_karyawan',
        'tipe_perusahaan',
    ];
}
