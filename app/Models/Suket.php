<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suket extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'no_surat',
        'tanggal',
        'bulan',
        'tahun',
        'pengajuan_id',
        'dpc',
        'dokumen'
    ];
}
