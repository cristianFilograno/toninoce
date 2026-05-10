<?php

namespace App\Filament\Resources\DownloadResource\Pages;

use App\Filament\Resources\DownloadResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;

class CreateDownload extends CreateRecord
{
    protected static string $resource = DownloadResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (!empty($data['file_path'])) {
            $path = $data['file_path'];
            $data['file_tipo']       = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            $data['file_nome']       = basename($path);
            $fullPath = Storage::disk('public')->path($path);
            $data['file_dimensione'] = file_exists($fullPath) ? filesize($fullPath) : null;
        }

        return $data;
    }
}
