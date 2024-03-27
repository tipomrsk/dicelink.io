<?php

namespace App\Enums\Tables;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum HasMaster: int implements HasColor, HasDescription, HasLabel
{
    case HAS_MASTER = 0;
    case NO_MASTER = 1;

    public function getColor(): string|array|null
    {

        return match ($this) {
            self::HAS_MASTER => 'success',
            self::NO_MASTER => 'warning',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::HAS_MASTER => 'Has Master on Table',
            self::NO_MASTER => 'No Master on Table',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::HAS_MASTER => 'Has Master',
            self::NO_MASTER => 'No Master',
        };
    }
}
