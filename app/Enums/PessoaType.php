<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PessoaType: string implements HasLabel
{
    case PessoaFisica = 'F';
    case PessoaJuridica = 'J';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PessoaFisica => 'Pessoa Física',
            self::PessoaJuridica => 'Pessoa Jurídica',
        };
    }
}
