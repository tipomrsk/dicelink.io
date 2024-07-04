<?php

namespace App\Enums\Campaings;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum IsOnline: int implements HasColor, HasLabel
{
    case ONLINE = 1;
    case IN_PERSON = 0;

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::ONLINE => 'info',
            self::IN_PERSON => 'success',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::ONLINE => 'Online',
            self::IN_PERSON => 'In Person',
        };
    }
}
