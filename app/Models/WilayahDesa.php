<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WilayahDesa extends Model
{
    use HasFactory;

    protected $table = 'wilayah_desa';

    protected $fillable = [
        'id',
        'kecamatan_id',
        'nama'
    ];
}
