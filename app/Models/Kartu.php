<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kartu extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nik',
        'nomor',
        'bulan',
        'tahun',
        'scan_kta'
    ];
}
