<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nama_perusahaan', 'profil_perusahaan', 'nama_pic', 'posisi_pic', 'nomor_telepon',
        'country', 'provinsi', 'kabupaten', 'jumlah_karyawan', 'tipe_perusahaan'
    ];
}
