<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WilayahKecamatan extends Model
{
    use HasFactory;

    protected $table = 'wilayah_kecamatan';

    protected $fillable = [
        'id',
        'kabupaten_id',
        'nama'
    ];

    public function kabupaten()
    {
        return $this->belongsTo(WilayahKabupaten::class, 'kabupaten_id');
    }
}
