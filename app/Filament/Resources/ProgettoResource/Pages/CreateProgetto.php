<?php

namespace App\Filament\Resources\ProgettoResource\Pages;

use App\Filament\Resources\ProgettoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProgetto extends CreateRecord
{
    protected static string $resource = ProgettoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Filament v5 restituisce array per FileUpload multiplo — normalizziamo
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
