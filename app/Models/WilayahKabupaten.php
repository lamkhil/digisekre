<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WilayahKabupaten extends Model
{
    use HasFactory;

    protected $table = 'wilayah_kabupaten';

    protected $fillable = [
        'id',
        'provinsi_id',
        'nama'
    ];

    public function provinsi()
    {
        return $this->belongsTo(WilayahProvinsi::class, 'provinsi_id');
    }
}
