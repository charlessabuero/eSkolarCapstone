<?php

namespace App\Filament\Resources\RequirementResource\Pages;

use App\Filament\Resources\RequirementResource;
use App\Models\RequirementUser;
use App\Models\User;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRequirement extends ViewRecord
{
    protected static string $resource = RequirementResource::class;

    protected function getActions(): array
    {
        return [
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if((User::checkScholar(auth()->user()->id)))
            $data['document'] = RequirementUser::where('user_id',auth()->id())->where('requirement_id',$data['id'])->first()->document;
        return $data;
    }
}
