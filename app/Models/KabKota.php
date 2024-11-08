<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabKota extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama_kab',
        'nama_provinsi',
        'dpc',
        'created_user',
        'updated_user'
    ];
}
