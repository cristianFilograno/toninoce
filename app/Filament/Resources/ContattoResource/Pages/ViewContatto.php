<?php

namespace App\Filament\Resources\ContattoResource\Pages;

use App\Filament\Resources\ContattoResource;
use Filament\Resources\Pages\ViewRecord;

class ViewContatto extends ViewRecord
{
    protected static string $resource = ContattoResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Segna automaticamente come letto quando si apre il messaggio
        $this->record->update(['letto' => true, 'letto_at' => now()]);
        return $data;
    }
}
