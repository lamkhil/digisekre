<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serkom extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nik',
        'no_serkom',
        'tanggal_terbit',
        'scan_serkom'
    ];
}
