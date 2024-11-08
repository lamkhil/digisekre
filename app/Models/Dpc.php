<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dpc extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama_dpc',
        'ketua',
        'alamat',
        'hotline',
        'email',
        'akronim_1',
        'akronim_2',
        'tempat',
        'ttd',
        'kop',
        'akronim_3',
        'akronim_4',
        'akronim_5',
        'akronim_6',
        'created_user',
        'updated_user'

    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
