<?php

namespace App\Models;

use App\Enum\JenisKelaminStatus;
use App\Enum\ReligionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Anggota extends Model
{
    use HasFactory;

    protected $primaryKey = 'nik';
}
