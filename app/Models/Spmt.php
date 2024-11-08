<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smpt extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'anggota_nik',
        'pekerjaan_id',
        'scan_spmt',

    ];
}
