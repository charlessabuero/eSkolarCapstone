<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequirementResource\Pages;
use App\Filament\Resources\RequirementResource\RelationManagers;
use App\Models\Module;
use App\Models\Requirement;
use App\Models\RequirementUser;
use App\Models\Role;
use App\Models\Scholar;
use App\Models\User;
use App\Models\Year;
use Closure;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\ActivityLogger;
use Spatie\Activitylog\ActivityLogStatus;


class RequirementResource extends Resource
{
    protected static ?string $navigationGroup = 'Requirements Management';

    protected static ?string $model = Requirement::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                Group::make([
                    Card::make([
                        TextInput::make('description'),
                        Select::make('filetypes')
                            ->options([
                                'application/pdf' => 'Portable Document Format/PDF',
                                'application/vnd.ms-powerpoint' => 'Microsoft PowerPoint',
                                'application/vnd.ms-excel' => 'Microsoft Excel',
                                'text/csv' => 'Comma-separated values (CSV)',
                                'image/jpeg' => 'JPEG images',
                                'image/png' => 'PNG images',
                            ])
                            ->multiple(),
                    ])->columnSpan(2)->columns(2),
                    Card::make([
                        FileUpload::make('document')
                            ->enableDownload()
                            ->enableOpen()
                    ])->hidden(!(User::checkScholar(auth()->id())))

                ])->columns(2)
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TagsColumn::make('filetypes'),
                Tables\Columns\TextColumn::make('users.status')
                    ->label('Status')
                    ->formatStateUsing(function ($record) {
                        $state = $record->users()->where('user_id', auth()->id())->first()->pivot->status ?? 'No submission';
                        return Str::title($state);
                    })
                    ->hidden(fn () => !(User::checkScholar(auth()->user()->id))),
                Tables\Columns\TextColumn::make('users.is_approved')
                    ->formatStateUsing(function ($record) {
                        $requirement = RequirementUser::where('requirement_id', $record->id)->where('user_id', auth()->id())->first();
                        $state = $requirement->is_approved ? 'Approved' : ($requirement->status ? 'To Be Check' : 'No Submission');
                        return Str::title($state);
                    })
                    ->label('Approved')
                    ->hidden(fn () => !(User::checkScholar(auth()->user()->id))),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('submit')
                    ->hidden(function ($record) {
                        if ((User::checkScholar(auth()->user()->id))) {
                            $requirement = RequirementUser::where('requirement_id', $record->id)->where('user_id', auth()->id())->first();
                            return ($requirement->is_approved ? true : false);
                        } else
                            return true;
                    })
                    ->color(function ($record) {
                        $user = $record->users()->where('user_id', auth()->id())->first();
                        return $user->pivot->status ? 'success' : 'primary';
                    })
                    ->label(function ($record) {
                        $user = $record->users()->where('user_id', auth()->id())->first();
                        return $user->pivot->status ? 'Resubmit' : 'Submit';
                    })
                    ->button()
                    ->action(function ($data, $record) {
                        $user = User::find(auth()->user()->id);

                        $requirement = $user->requirements();

                        $requirement->updateExistingPivot($record->id, [
                            'status' => 'submitted',
                            'document' => $data['document']
                        ]);
                        $description = Filament::getUserName(auth()->user()). " submits " . $record->description;
                        app(ActivityLogger::class)
                            ->useLog("Account Action")
                            ->setLogStatus(app(ActivityLogStatus::class))
                            ->withProperties([
                                'status' => 'submitted',
                                'document' => $data['document'],
                                'name' => $record->description,
                                'action_by' => $user->name
                            ])
                            ->event('Submitted Requirement')
                            ->log($description);
                    })
                    ->mountUsing(fn ($form, $record) => $form->fill([
                        'description' => $record->description
                    ]))
                    ->form([
                        TextInput::make('description')
                            ->disabled(),
                        FileUpload::make('document')
                            ->acceptedFileTypes(fn ($record) => $record->filetypes)
                    ]),
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                        ->hidden(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    public static function getEloquentQuery(): Builder
    {
        $scholar = Scholar::firstWhere('user_id', auth()->user()->id);
        if ($scholar) {
            return Requirement::getAllRequirementsScholar(auth()->user()->id);
        }
        return Requirement::getRequirements();
    }
    // public static function canViewAny(): bool
    // {
    //     $user = Cache::get('user:'.auth()->user()->id);

    //     return Module::view(Module::level($user, static::$model));
    // }
    // public static function canCreate(): bool
    // {
    //     $user = Cache::get('user:'.auth()->user()->id);

    //     return Module::manage(Module::level($user, static::$model));
    // }

    public static function getRelations(): array
    {
        return [
            RelationManagers\UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageRequirements::route('/'),
            'view' => Pages\ViewRequirement::route('/{record}'),
        ];
    }
}
