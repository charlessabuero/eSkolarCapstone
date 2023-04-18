<?php

namespace App\Filament\Resources\RequirementResource\RelationManagers;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';
    protected static ?string $modelLabel = 'Scholars';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                FileUpload::make('document')
                    ->enableOpen()
                    ->enableDownload()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                TextColumn::make('status')
                    ->formatStateUsing(function ($record) {
                        $state = $record->pivot->status ?? 'No submission';
                        return Str::title($state);
                    })
            ])
            ->filters([
                //
            ])
            ->headerActions([])
            ->actions([
                Action::make('approval')
                    ->modalButton('Approve')
                    ->visible(
                        function ($record) {
                            return ((!($record->is_approved)) && ($record->pivot->document));
                        }
                    )
                    ->hidden(fn ($record) => ($record->pivot->is_approved == true))
                    ->disabled(fn ($record) => ($record->pivot->is_approved == true))
                    ->button()
                    ->label('Approve')
                    ->form([
                        Forms\Components\TextInput::make('name')
                            ->disabled()
                            ->required(),
                        FileUpload::make('document')
                            ->disabled()
                            ->enableDownload()
                            ->enableOpen()
                    ])->mountUsing(fn ($form, $record) => $form->fill([
                        'name' => $record->name,
                        'document' => $record->document,
                    ]))
                    ->action(function ($action, $record) {
                        $user = User::find($record->user_id)->requirements()->updateExistingPivot($record->requirement_id, [
                            'is_approved' => true
                        ]);
                        if ($user)
                            $action->success();
                        else
                            $action->failure();
                    }),

                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
    }
}
