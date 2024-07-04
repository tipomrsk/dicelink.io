<?php

namespace App\Filament\Resources\TableTopResource\Pages;

use App\Filament\Resources\CampaingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTableTops extends ListRecords
{
    protected static string $resource = CampaingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
