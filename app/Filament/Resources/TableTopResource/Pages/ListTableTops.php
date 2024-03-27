<?php

namespace App\Filament\Resources\TableTopResource\Pages;

use App\Filament\Resources\TableTopResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTableTops extends ListRecords
{
    protected static string $resource = TableTopResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}