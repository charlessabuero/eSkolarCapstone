<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\LatestAnnouncements;
use App\Filament\Widgets\RequirementProgress;
use App\Filament\Widgets\ScholarshipProgramsOverview;
use App\Filament\Widgets\ScholarsOverview;
use App\Models\Role;
use Filament\Pages\Page;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?int $navigationSort = -2;

    protected static string $view = 'filament::pages.dashboard';

    protected static function getNavigationLabel(): string
    {
        return static::$navigationLabel ?? static::$title ?? __('filament::pages/dashboard.title');
    }

    public static function getRoutes(): Closure
    {
        return function () {
            Route::get('/', static::class)->name(static::getSlug());
        };
    }

    protected function getWidgets(): array
    {
        // if (auth()->user()->role_id == Cache::get('role:'.'Admin')->id)
        //     return [ScholarsOverview::class, LatestAnnouncements::class, ScholarshipProgramsOverview::class,];
        // if (auth()->user()->role_id == Cache::get('role:'.'Scholar')->id)
        //     return [RequirementProgress::class, LatestAnnouncements::class];
        return Filament::getWidgets();
    }

    protected function getColumns(): int | array
    {
        return 2;
    }

    protected function getTitle(): string
    {
        return static::$title ?? __('filament::pages/dashboard.title');
    }
}
