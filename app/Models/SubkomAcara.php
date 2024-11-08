<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubkomAcara extends Model
{
    use HasFactory;

    protected $fillable = [
        'subkom_acara_id',
        'subkompetensi_id',
        'instansi_id',
        'acara_id',
        
    ];
}
