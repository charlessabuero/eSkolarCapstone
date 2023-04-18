<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScholarResource\Pages;
use App\Filament\Resources\ScholarResource\RelationManagers;
use App\Models\College;
use App\Models\Module;
use App\Models\Program;
use App\Models\Scholar;
use App\Models\ScholarshipOrganization;
use App\Models\ScholarshipProgram;
use App\Services\SMSService;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Closure;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Filters\Layout;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Ysfkaya\FilamentPhoneInput\PhoneInput;
use Illuminate\Support\Facades\Cache;

class ScholarResource extends Resource
{

    protected static ?string $model = Scholar::class;
    protected static ?string $modelLabel = 'Scholar';

    protected static ?string $navigationGroup = 'Scholarships Management';
    protected static ?string $navigationIcon = 'fas-user-tie';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                Group::make([
                    Group::make([
                        Section::make('Personal Information')
                            ->schema([
                                Group::make([
                                    TextInput::make('fname')
                                        ->label('First Name'),
                                    TextInput::make('lname')
                                        ->label('Last Name'),
                                    TextInput::make('email'),
                                    PhoneInput::make('contact_number')
                                        ->required()
                                        ->initialCountry('ph')
                                        ->disallowDropdown()
                                        ->separateDialCode(true),
                                    Group::make([
                                        TextInput::make('id')
                                            ->required()
                                            ->label('ID #')->columnSpan(2),
                                        Select::make('baranggay_id')
                                            ->relationship('baranggay', 'name')
                                            ->required()
                                            ->label('Barangay')->columnSpan(1),
                                        Select::make('program_id')
                                            ->relationship('program', 'name')
                                            ->required()->columnSpan(2)
                                    ])->columnSpan(2)->columns(3)
                                ])->columns(2),
                            ])->columnSpan(2),
                        Section::make('Scholarship Information')
                            ->schema([
                                Select::make('scholarship_program_id')
                                    ->relationship('scholarship_program', 'name')
                                    ->label('Scholarship Program')
                                    ->required(),
                            ])->columnSpan(1),
                    ])->columns(3),
                ]),
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('scholar_id')
                    ->label('ID #')
                    ->searchable(),
                TextColumn::make('fname')
                    ->searchable()
                    ->sortable()
                    ->label('First Name'),
                TextColumn::make('lname')
                    ->searchable()
                    ->sortable()
                    ->label('Last Name'),
                TextColumn::make('user.email')
                    ->searchable()
                    ->sortable()
                    ->label('Email'),
                TextColumn::make('user.contact_number')
                    ->searchable()
                    ->sortable()
                    ->label('Contact Number'),

                TextColumn::make('baranggay.name')
                    ->sortable()
                    ->label('Barangay'),
                TextColumn::make('sponsor.sponsor')
                    ->tooltip(fn ($record) => $record->sponsor->sponsor)
                    ->toggleable()
                    ->sortable()
                    ->label('Sponsor'),
                TextColumn::make('scholarship_program.name')
                    ->tooltip(fn ($record) => $record->scholarship_program->name)
                    ->toggleable()
                    ->sortable()
                    ->label('Scholarship Program'),
                TextColumn::make('college.abbre')
                    ->sortable()
                    ->toggleable()
                    ->tooltip(fn ($record) => $record->college->name)
                    ->formatStateUsing(fn ($state) => Str::upper($state))
                    ->label('College'),
                TextColumn::make('program.abbre')
                    ->sortable()
                    ->toggleable()
                    ->tooltip(fn ($record) => $record->program->name)
                    ->formatStateUsing(fn ($state) => Str::upper($state))
                    ->label('Course'),
                BadgeColumn::make('status')
                    ->sortable()
                    ->enum([
                        '1' => 'Pending',
                        '2' => 'Inactive',
                        '3' => 'Active',
                        '4' => 'Deactivated',
                    ])
                    ->colors([
                        'primary',
                        'warning' => static fn ($state): bool => $state == '1',
                        'danger' => static fn ($state): bool => $state == '2',
                        'success' => static fn ($state): bool => $state == '3',
                        'success' => static fn ($state): bool => $state == '4',
                    ]),
            ])
            ->filters([
                Filter::make('scholarship')
                    ->form([
                        Select::make('sponsor')
                            ->label('Scholarship Sponsor')
                            ->multiple()
                            ->placeholder('All')
                            ->options(Cache::get('sponsors')->pluck('sponsor','id')),
                        Select::make('scholarship_organization')
                            ->label('Scholarship Organization')
                            ->multiple()
                            ->placeholder('All')
                            ->options(function ($get) {
                                return $get('sponsor') ?
                                    ScholarshipOrganization::whereRelation('sponsors', function (Builder $query) use ($get) {
                                        return $query->whereIn('sponsor_id', $get('sponsor'));
                                    })->pluck('name', 'id') : ScholarshipOrganization::pluck('name', 'id');
                            }),
                        Select::make('scholarship_program')
                            ->label('Scholarship Program')
                            ->multiple()
                            ->placeholder('All')
                            ->options(function (Closure $get) {
                                return $get('sponsor') ? ScholarshipProgram::whereIn('sponsor_id', $get('sponsor'))->pluck('name', 'id') : Cache::get('scholarship_programs:pluck');
                            })
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['sponsor'],
                                function (Builder $query, $sponsors) {
                                    return $query->whereRelation('sponsor', function (Builder $query) use ($sponsors) {
                                        return $query->whereIn('sponsor_id', $sponsors);
                                    });
                                }
                            )
                            ->when(
                                $data['scholarship_organization'],
                                function (Builder $query, $scholarship_organizations) {
                                    return $query->whereRelation('scholarship_organization', function (Builder $query) use ($scholarship_organizations) {
                                        return $query->whereIn('scholarship_organization_id', $scholarship_organizations);
                                    });
                                }
                            )
                            ->when(
                                $data['scholarship_program'],
                                function (Builder $query, $scholarship_programs) {
                                    return $query->whereRelation('scholarship_program', function (Builder $query) use ($scholarship_programs) {
                                        return $query->whereIn('scholarship_program_id', $scholarship_programs);
                                    });
                                }
                            );;
                    }),
                Filter::make('curriculum')
                    ->form([
                        Select::make('college')
                            ->multiple()
                            ->options(Cache::get('colleges:pluck'))
                            ->placeholder('All'),
                        Select::make('program')
                            ->multiple()
                            ->placeholder('All')
                            ->options(function (Closure $get) {
                                return $get('college') ? Program::whereIn('college_id', $get('college'))->pluck('name', 'id') : Program::pluck('name', 'id');
                            })
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['college'],
                                function (Builder $query, $colleges) {
                                    return $query->whereRelation('college', function (Builder $query) use ($colleges) {
                                        return $query->whereIn('college_id', $colleges);
                                    });
                                }
                            )
                            ->when(
                                $data['program'],
                                function (Builder $query, $programs) {
                                    return $query->whereRelation('program', function (Builder $query) use ($programs) {
                                        return $query->whereIn('program_id', $programs);
                                    });
                                }
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        $colleges = [];
                        $programs = [];
                        if ($data['college'] ?? null)
                            foreach ($data['college'] as $value)
                                $colleges[] = Str::upper(College::where('id', $value)->first()->abbre);

                        if ($data['program'] ?? null)
                            foreach ($data['program'] as $value)
                                $programs[] = Str::upper(Program::where('id', $value)->first()->abbre);


                        $data['college'] ? $indicators['college'] = 'College: ' . Arr::join($colleges, ', ', ' & ') : null;
                        $data['program'] ? $indicators['program'] = 'Course: ' . Arr::join($programs, ', ', ' & ') : null;
                        return $indicators;
                    }),
                SelectFilter::make('baranggay')
                    ->label('Barangay')
                    ->multiple()
                    ->relationship('baranggay', 'name'),
                SelectFilter::make('status')
                    ->label('Scholarship Status')
                    ->multiple()
                    ->options([
                        '1' => 'Pending',
                        '2' => 'Inactive',
                        '3' => 'Active',
                        '4' => 'Deactivated',
                    ]),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('send_sms')
                    ->icon('fas-comment')
                    ->label('Send Sms')
                    ->form([
                        TextInput::make('message')
                            ->required()
                    ])
                    ->action(function ($records, $data, BulkAction $action) {
                        foreach ($records as $value) {
                            SMSService::sendMessage($data);
                        }
                    }),

            ]);
    }
    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageScholars::route('/'),
            'view' => Pages\ViewScholar::route('/{record}'),
        ];
    }
}
