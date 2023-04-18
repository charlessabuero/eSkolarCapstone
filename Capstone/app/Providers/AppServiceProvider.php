<?php

namespace App\Providers;

use App\Filament\AcademicWidgets\Academic\Heading;
use App\Filament\AcademicWidgets\Academic\Item;
use App\Models\User;
use App\Observers\UserObserver;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // User::observe(UserObserver::class);

        Livewire::component('academic-heading', Heading::class);
        Livewire::component('academic-item', Item::class);

        Filament::registerRenderHook(
            'global-search.start',
            fn (): View => view('filament.widgets.academic.heading')
        );

        Filament::serving(function () {
            Filament::registerUserMenuItems([
                'profile' =>
                    UserMenuItem::make()
                        ->url(route('filament.pages.profile'))
                        ->label('Profile')
                        ->icon('heroicon-o-user'),
            ]);
        });
    }
}
