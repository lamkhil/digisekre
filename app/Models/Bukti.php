<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bukti extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama',
        'anggota_nik',
        'nominal',
        'tahun',
        'sumber',
        'operator',
        'keterangan',
        'pesan',
        'dokumen',
        'dpc'
    ];
}
