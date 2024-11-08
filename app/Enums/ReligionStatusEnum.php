<?php

namespace App\Enum;

use Filament\Support\Contracts\HasLabel;
 
enum ReligionStatus: string implements HasLabel
{
    case Islam = 'Islam';
    case Kristen = 'Kristen';
    case Buddha = 'Buddha';
    case Katolik = 'Katolik';
    case Hindu = 'Hindu';
    case KongHucu = 'Konghucu';
    
    public function getLabel(): ?string
    {
        return $this->name;
    
        return match ($this) {
            self::Islam => 'Islam',
            self::Kristen => 'Kristen',
            self::Buddha => 'Buddha',
            self::Katolik => 'Katolik',
            self::Hindu => 'Hindu',
            self::KongHucu => 'Konghucu',
        };
    }
}