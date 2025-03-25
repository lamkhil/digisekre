<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, HasAvatar
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

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }

    public function getAvatarUrlAttribute(): ?string
    {
        if($this->avatar) {
            return asset('storage/' . $this->avatar);
        } else {
            return 'https://ui-avatars.com/api/?name=' . urlencode(str_replace('-', '', $this->name));
        }
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
