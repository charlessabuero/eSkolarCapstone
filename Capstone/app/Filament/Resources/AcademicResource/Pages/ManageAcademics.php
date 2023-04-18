<?php

namespace App\Filament\Resources\AcademicResource\Pages;

use App\Filament\Resources\AcademicResource;
use App\Models\Academic;
use App\Models\Year;
use Carbon\Carbon;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;
use Savannabits\Flatpickr\Flatpickr;

class ManageAcademics extends ManageRecords
{
    protected static string $resource = AcademicResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->disableCreateAnother()
                ->using(function ($data) {
                    // if(Academic::firstOrCreate())
                    $year = Year::firstWhere('year', $data['year']);
                    if ($year)
                        if (Academic::where('year_id', $year->id)->where('semester_id', $data['semester_id'])->first())
                            $this->halt();

                    $academic = Academic::createAcademic(
                        $data['year'],
                        $data['semester_id'],
                        Carbon::parse($data['start']),
                        Carbon::parse($data['end']),
                    );
                    return $academic;
                })
                ->form([
                    Card::make([
                        TextInput::make('year')
                            ->rules(['date_format:Y'])
                            ->required()
                            ->hint('ex. 2019')
                            ->afterStateUpdated(fn ($state) => $state . ' - '),
                        Select::make('semester_id')
                            ->required()
                            ->label('Semester')
                            ->relationship('semester', 'semester'),
                        DatePicker::make('start')
                            ->required()
                            ->label('Starting Date'),
                        DatePicker::make('end')
                            ->required()
                            ->label('Ending Date'),
                    ])->columns(2)
                ]),
        ];
    }
}
