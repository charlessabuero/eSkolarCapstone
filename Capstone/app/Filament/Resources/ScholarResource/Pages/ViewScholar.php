<?php

namespace App\Filament\Resources\ScholarResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\ScholarResource;
use App\Models\User;

class ViewScholar extends ViewRecord
{
    protected static string $resource = ScholarResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $user = User::find($data['user_id']);
        $data['email'] = $user->email;
        $data['contact_number'] = $user->contact_number;
        return $data;
    }
}
