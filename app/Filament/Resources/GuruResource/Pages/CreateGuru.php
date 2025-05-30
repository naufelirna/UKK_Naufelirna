<?php

namespace App\Filament\Resources\GuruResource\Pages;

use App\Filament\Resources\GuruResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGuru extends CreateRecord
{
    protected static string $resource = GuruResource::class;

    protected function getRedirectUrl(): string
    {
        // redirect ke halaman index daftar guru setelah berhasil create
        return $this->getResource()::getUrl('index');
    }
}
