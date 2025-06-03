<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Filament\Resources\SiswaResource;
use Filament\Actions;
use App\Models\User;
use Filament\Resources\Pages\EditRecord;

class EditSiswa extends EditRecord
{
    protected static string $resource = SiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }
     protected function mutateFormDataBeforeSave(array $data): array
    {
        $oldEmail = $this->record->email;

        if ($data['email'] !== $oldEmail) {
            $user = User::where('email', $oldEmail)->first();

            if ($user) {
                $user->update([
                    'email' => $data['email'],
                ]);
            }
        }

    return $data;
}
}