<?php

namespace App\Providers;

use Filament\Pages\Dashboard;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Filament\Resources\UserResource;
use Filament\Navigation\NavigationGroup;
use App\Filament\Resources\CampusResource;
use App\Filament\Resources\CourseResource;
use Filament\Navigation\NavigationBuilder;
use App\Filament\Resources\StudentResource;

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
       

    
Filament::navigation(function (NavigationBuilder $builder): NavigationBuilder {
    return $builder
        ->groups([
           
          
            NavigationGroup::make()
                ->items([
                    NavigationItem::make('Dashboard')
                    ->icon('heroicon-o-home')
                    ->activeIcon('heroicon-s-home')
                    ->isActiveWhen(fn (): bool => request()->routeIs('filament.pages.dashboard'))
                    ->url(route('filament.pages.dashboard')),
                ]),
            NavigationGroup::make('System')
                ->items([
                 
                    ...UserResource::getNavigationItems(),
                ]),
            NavigationGroup::make('University')
                ->items([
                    ...CampusResource::getNavigationItems(),
                    ...CourseResource::getNavigationItems(),
                    ...StudentResource::getNavigationItems(),
                ]),
            NavigationGroup::make('Documents')
                ->items([
                    NavigationItem::make('Reports')
                    ->icon('heroicon-o-document-text')
                    ->activeIcon('heroicon-s-document-text')
                    ->isActiveWhen(fn (): bool => request()->routeIs('filament.pages.reports'))
                    ->url(route('filament.pages.reports')),
                ]),
        ]);
});
        
    }
}
