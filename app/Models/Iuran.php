<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iuran extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getFotoIuranUrlAttribute()
    {
        return $this->foto_iuran ? asset('storage/' . $this->foto_iuran) : null;
    }
}
