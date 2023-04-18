<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AcademicResource\Pages;
use App\Filament\Resources\AcademicResource\RelationManagers;
use App\Models\Academic;
use App\Models\Module;
use App\Models\User;
use App\Models\Year;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Carbon\Carbon;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\Facades\Cache;
use Savannabits\Flatpickr\Flatpickr;

class AcademicResource extends Resource
{
    protected static ?string $modelLabel = 'Academic Year';
    protected static ?string $model = Academic::class;
    protected static ?string $navigationGroup = 'Curriculum Management';

    protected static ?string $navigationIcon = 'fas-school';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Group::make([
                        TextInput::make('year')
                            ->label('Starting Year')
                            ->disabled(),
                    ]),
                    Select::make('semester_id')
                        ->relationship('semester', 'semester')
                        ->disabled(),
                    DatePicker::make('start'),
                    DatePicker::make('end'),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('year.year')
                    ->formatStateUsing(fn ($state) => Year::getAcademicYear($state)),
                Tables\Columns\TextColumn::make('semester.semester')
                    ->formatStateUsing(fn ($state) => $state . ' Semester'),
                Tables\Columns\TextColumn::make('start')
                    ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('M-d-Y'))
                    ->toggleable(),
                Tables\Columns\TextColumn::make('end')
                    ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('M-d-Y'))

                    ->toggleable(),
                Tables\Columns\IconColumn::make('default')
                    ->toggleable()
                    ->label('Current Academic')
                    ->options([
                        'heroicon-o-check',
                        'heroicon-o-x' => static fn ($state): bool => $state === 0,
                    ])
                    ->colors([
                        'primary',
                        'danger' => static fn ($state): bool => $state === 0,
                    ]),
                TextColumn::make('remaining days')
                    ->toggleable()
                    ->getStateUsing(function ($record) {
                        $end = new Carbon($record->end);
                        if ($end->lt(Carbon::now()))
                            return 0;
                        return $end->diffInDays(Carbon::now(), true);
                    })
            ])
            ->filters([])
            ->actions([
                Action::make('complete')
                    ->color('success')
                    ->button()
                    ->disabled(function ($record) {
                        $end = new Carbon($record->end);
                        return !($end->lt(Carbon::now()));
                    })->hidden(function ($record) {
                        $end = new Carbon($record->end);
                        return !($end->lt(Carbon::now()));
                    }),
                Action::make('make_default')
                    ->disabled(function ($record) {
                        $end = new Carbon($record->end);
                        return $record->default || $end->lt(Carbon::now());
                    })
                    ->action(fn ($record) => Academic::setDefaultAcademic($record->id))
                    ->hidden(function ($record) {
                        $end = new Carbon($record->end);
                        return $record->default || $end->lt(Carbon::now());
                    })
                    ->button(),
                ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label('Edit Dates')
                        ->mutateRecordDataUsing(function (array $data, $record) {
                            $year = Year::find($record->year_id)->year;
                            $data['year'] = Year::getAcademicYear(year: $year);
                            return $data;
                        }),
                    Tables\Actions\DeleteAction::make(),
                ])

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAcademics::route('/'),
        ];
    }

}
