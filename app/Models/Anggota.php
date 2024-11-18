<?php

namespace App\Models;

use App\Enum\JenisKelaminStatus;
use App\Enum\ReligionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Anggota extends Model
{
    use HasFactory;

    protected $primaryKey = 'nik';
    
    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jk',
        'agama',
        'gd',
        'status',
        'pekerjaan',
        'alamat',
        'rt',
        'rw',
        'desa_kel',
        'kec',
        'provinsi',
        'ktp',
        'foto'
    ];
}
