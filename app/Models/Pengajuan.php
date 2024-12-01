<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nik',
        'nama',
        'tanggal_lahir',
        'pendidikan',
        'jenis',
        'deskripsi',
        'no_str',
        'tempat_kerja',
        'kab_kota',
        'dpc',
        'kta',
        'almamater',
        'status',
        'pengaju',
        'pendukung',
        'verifikator',
        'pesan',
        'tanggal_verif',
        'dpc_baru',
        'kab_kota_baru',
        'tempat_kerja_baru',
        'cpd',
        'sanksi',    
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'nik', 'nik');
    }

    public function mutasi()
    {
        return $this->hasOne(Mutasi::class, 'pengajuan_id', 'id');
    }

    public function rekomendasi()
    {
        return $this->hasOne(Rekomendasi::class, 'pengajuan_id', 'id');
    }
}

