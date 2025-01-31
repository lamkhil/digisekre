<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, HasRelationships;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function dpc()
    {
        return $this->belongsTo(Dpc::class);
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'nik', 'nik');
    }

    public function str()
    {
        return $this->belongsTo(Str::class, 'nik', 'nik');
    }
    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'nik', 'nik');
    }
    
    public function iuran()
    {
        return $this->hasMany(Iuran::class, 'anggota_nik', 'nik');
    }
    public function serkom()
    {
        return $this->belongsTo(Serkom::class, 'nik', 'nik');
    }
    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class, 'nik', 'nik');
    }
    public function sumprof()
    {
        return $this->belongsTo(Sumprof::class, 'nik', 'nik');
    }

    public function kartu()
    {
        return $this->belongsTo(Kartu::class, 'nik', 'nik');
    }
}
