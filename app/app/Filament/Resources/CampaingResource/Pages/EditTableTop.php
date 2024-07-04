<?php

namespace App\Filament\Resources\TableTopResource\Pages;

use App\Filament\Resources\CampaingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTableTop extends EditRecord
{
    protected static string $resource = CampaingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
