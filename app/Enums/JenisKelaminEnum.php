<?php

namespace App\Enum;
use Filament\Support\Contracts\HasLabel;
 
enum JenisKelaminStatus: string implements HasLabel
{
    case Lakilaki = 'Laki-laki';
    case Perempuan = 'Perempuan';
   
    
    public function getLabel(): ?string
    {
        return $this->name;
    
        return match ($this) {
            self::Lakilaki => 'Laki-laki',
            self::Perempuan => 'Perempuan',
            
        };
    }
}