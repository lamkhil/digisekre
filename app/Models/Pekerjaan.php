<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nik',
        'jenis_instansi',
        'nama_instansi',
        'provinsi',
        'kab_kota',
        'awal_kerja',
        'status',
        'jabatan',
        'domain',
        'dpc',
        'nip',
        'pangkat',
        'jabatan_fungsional',
        'no_sk_jabfung',
        'tmt_jabfung'
    ];
}
