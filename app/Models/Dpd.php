<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dpd extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama_dpd',
        'ketua',
        'alamat',
        'hotline',
        'email',
        'created_user',
        'updated_user'
    ];
}
