<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranah extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranah_id',
        'nama_ranah'
    ];
}
