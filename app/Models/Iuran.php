<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iuran extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama',
        'anggota_nik',
        'nominal',
        'tahun',
        'sumber',
        'dpc',
        'operator',
        'keterangan'
    ];
}
