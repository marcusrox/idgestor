<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum NaturezaOperacaoType: string implements HasLabel
{
    case Venda = 'VENDA';
    case Bonificacao = 'BONIF';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Venda => 'Venda',
            self::Bonificacao => 'Bonificações',
        };
    }
}
