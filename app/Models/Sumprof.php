<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sumprof extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nik',
        'tanggal_sumprof',
        'scan_sumprof_1',
        'scan_sumprof_2',
    ];
}
