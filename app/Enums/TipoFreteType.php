<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TipoFreteType: string implements HasLabel
{
    case FOB = 'FOB';
    case CIF = 'CIF';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::FOB => 'FOB',
            self::CIF => 'CIF',
        };
    }
}
