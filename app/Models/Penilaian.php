<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penilaians extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'anggota_nik',
        'str_id',
        'dpc',
        'borang',
        'dokumen',
        'status',
        'verifikator_id',
        'verifikator_name',
        'verifikator_date',
        'pesan_verifikator',
        'kontak',
        'validator_id',
        'validator_name',
        'validator_date',
        'pesan_validator'
    ];
}
