<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Str extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nik',
        'no_str',
        'no_serkom',
        'tanggal_terbit',
        'tanggal_berakhir',
        'scan_str',
        'kunci'
    ];
}
