<?php

namespace App\Filament\Resources\ProgettoResource\Pages;

use App\Filament\Resources\ProgettoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgetti extends ListRecords
{
    protected static string $resource = ProgettoResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()->label('Nuovo progetto')];
    }
}
