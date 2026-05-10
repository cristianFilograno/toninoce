<?php

namespace App\Filament\Resources\ProgettoResource\Pages;

use App\Filament\Resources\ProgettoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgetto extends EditRecord
{
    protected static string $resource = ProgettoResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Normalizziamo l'array galleria
        if (isset($data['galleria']) && is_array($data['galleria'])) {
            $data['galleria'] = array_values($data['galleria']);
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
