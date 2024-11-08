<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikatLama extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'tahun',
        'skp',
        'kode',
        'nomor',
        'nama',
        'jenis',
        'event',
        'penyelenggara',
        'judul',
        'awal',
        'akhir',
        'tempat'
    ];
}
