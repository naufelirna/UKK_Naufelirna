<?php

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;

class EditAdmin extends EditRecord
{
    protected static string $resource = AdminResource::class;

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

