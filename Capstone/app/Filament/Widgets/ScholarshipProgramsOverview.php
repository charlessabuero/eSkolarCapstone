<?php

namespace App\Filament\Widgets;

use App\Models\ScholarshipProgram;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Closure;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class ScholarshipProgramsOverview extends BaseWidget
{
    use HasWidgetShield;
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    protected function getTableQuery(): Builder
    {
        return ScholarshipProgram::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
                ->searchable(),
            TextColumn::make('scholars_count')
                ->label('Total Scholars')
                ->counts('scholars')
        ];
    }
}
