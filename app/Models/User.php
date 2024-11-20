<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser

{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'nik',
        'kab_kota',
        'dpc',
        'dpd',
        'wa',
        'mutasi',
        'verif',
        'instansi_id',
        'role_id',
        'is_active',
    ];

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
        return $this->belongsTo(Str::class, 'nik', 'nik');
    }
    public function iuran()
    {
        return $this->belongsTo(Str::class, 'nik', 'nik');
    }
    public function serkom()
    {
        return $this->belongsTo(Str::class, 'nik', 'nik');
    }
    public function pendidikan()
    {
        return $this->belongsTo(Str::class, 'nik', 'nik');
    }
    public function semprof()
    {
        return $this->belongsTo(Str::class, 'nik', 'nik');
    }


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
}
