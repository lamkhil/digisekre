<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkompetisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'subkompetensi_id',
        'kompetensi_id',
        'nama_subkompetensi',
        
    ];
}
