<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kompentensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kompetensi_id',
        'nama_kompetensi'
    ];
}
