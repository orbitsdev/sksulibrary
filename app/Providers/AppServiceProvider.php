<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Filament\Navigation\NavigationGroup;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();


        // Filament::serving(function () {
        //     Filament::registerNavigationGroups([
        //         // NavigationGroup::make()
        //         //      ->label('Shop')
        //         //      ->icon('heroicon-s-shopping-cart'),
        //         // NavigationGroup::make()
        //         //     ->label('Blog')
        //         //     ->icon('heroicon-s-pencil'),
        //         // NavigationGroup::make()
        //         //     ->label('Settings')
        //         //     ->icon('heroicon-s-cog')
        //         //     ->collapsed(),
        //     ]);
        // });
        
    }
}
