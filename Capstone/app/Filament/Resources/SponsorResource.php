<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SponsorResource\Pages;
use App\Filament\Resources\SponsorResource\RelationManagers;
use App\Models\Module;
use App\Models\Sponsor;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Cache;

class SponsorResource extends Resource
{
    protected static ?string $model = Sponsor::class;
    protected static ?string $navigationGroup = 'Scholarships Management';
    protected static ?string $navigationIcon = 'fas-handshake-angle';
    protected static ?string $modelLabel = 'Sponsor';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('sponsor')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sponsor')
                    ->label('Sponsor Name')
                    ->searchable(),
                TextColumn::make('scholarship_programs_count')
                    ->sortable()
                    ->counts('scholarship_programs')
                    ->label('Total Scholarship Programs'),
                TextColumn::make('scholars_count')
                    ->sortable()
                    ->counts('scholars')
                    ->label('Total Scholars')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    public static function getRelations(): array
    {
        return [
            RelationManagers\ScholarshipProgramsRelationManager::class,
            RelationManagers\ScholarsRelationManager::class,
        ];
    }
    // public static function canViewAny(): bool
    // {
    //     $user = Cache::get('user:'.auth()->user()->id);

    //     return Module::view(Module::level($user, static::$model));
    // }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSponsors::route('/'),
            'view' => Pages\ViewSponsor::route('/{record}'),
        ];
    }
}
