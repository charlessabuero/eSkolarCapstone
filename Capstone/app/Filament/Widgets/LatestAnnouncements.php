<?php

namespace App\Filament\Widgets;

use App\Models\Announcement;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Closure;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestAnnouncements extends BaseWidget
{
    use HasWidgetShield;
    protected static ?int $sort = 2;
    protected function getTableQuery(): Builder
    {
        return Announcement::latest();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('title')
        ];
    }
}
