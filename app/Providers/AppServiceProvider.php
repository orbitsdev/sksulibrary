<?php

namespace App\Providers;

use Filament\Pages\Dashboard;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Filament\Navigation\NavigationItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Filament\Resources\UserResource;
use Filament\Navigation\NavigationGroup;
use App\Filament\Resources\QuoteResource;
use App\Filament\Resources\CampusResource;
use App\Filament\Resources\CardResource;
use App\Filament\Resources\CourseResource;
use Filament\Navigation\NavigationBuilder;
use App\Filament\Resources\StudentResource;
use App\Filament\Resources\RealtimeResource;
use App\Filament\Resources\DayRecordResource;
use App\Filament\Resources\IdDataResource;
use App\Filament\Resources\IndividualResource;
use App\Filament\Resources\QuequeResource;
use App\Filament\Resources\SalesReportResource;
use App\Filament\Resources\TellerResource;

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


        Filament::serving(function () {
            // Using Vite
            Filament::registerViteTheme('resources/css/filament.css');

            Filament::registerUserMenuItems([
                UserMenuItem::make()
                    ->label('Attendance')
                    ->url(route('attendance'))
                    ->icon('heroicon-s-clipboard-list'),

            ]);
        });


        Filament::navigation(function (NavigationBuilder $builder): NavigationBuilder {
            return $builder
                ->groups([

                    // Filament::registerUserMenuItems([
                    //     'account' => UserMenuItem::make()->url(route('attendance')),
                    //     // ...
                    // ]),

                    // Filament::registerUserMenuItems([
                    //     UserMenuItem::make()
                    //         ->label('Settings')
                    //         ->url(route('filament.pages.reports'))
                    //         ->icon('heroicon-s-cog'),
                    //     // ...
                    // ]),
                    NavigationGroup::make()
                        ->items([
                            NavigationItem::make('Dashboard')
                                ->icon('heroicon-o-home')
                                ->activeIcon('heroicon-s-home')
                                ->isActiveWhen(fn (): bool => request()->routeIs('filament.pages.dashboard'))
                                ->url(route('filament.pages.dashboard')),


                        ]),

                    NavigationGroup::make('Management')
                        ->items([
                            ...CardResource::getNavigationItems(),
                            ...UserResource::getNavigationItems(),
                            ...StudentResource::getNavigationItems(),
                            ...CourseResource::getNavigationItems(),
                            ...CampusResource::getNavigationItems(),
                            ...IdDataResource::getNavigationItems(),
                        //     NavigationItem::make('ID Settings')
                        //     ->icon('heroicon-o-user-circle')
                        //    ->activeIcon('heroicon-s-user-circle')
                        //     ->isActiveWhen(fn (): bool => request()->routeIs('filament.pages.manage-i-d'))
                        //      ->url(route('filament.pages.manage-i-d')),

                        ]),
                    NavigationGroup::make('Report')
                        ->items([
                            ...DayRecordResource::getNavigationItems(),
                            ...RealtimeResource::getNavigationItems(),
                            ...IndividualResource::getNavigationItems(),
                                NavigationItem::make('Daily Record ')
                                 ->icon('heroicon-o-document-text')
                                ->activeIcon('heroicon-s-document-text')
                                 ->isActiveWhen(fn (): bool => request()->routeIs('filament.pages.reports'))
                                  ->url(route('filament.pages.reports')),
                                  NavigationItem::make('Over All Visitors')
                                  ->icon('heroicon-o-user-group')
                                 ->activeIcon('heroicon-s-user-group')
                                  ->isActiveWhen(fn (): bool => request()->routeIs('filament.pages.daily-visitors'))
                                   ->url(route('filament.pages.daily-visitors')),
                                NavigationItem::make('Top Visitors')
                                 ->icon('heroicon-o-presentation-chart-bar')
                                ->activeIcon('heroicon-s-presentation-chart-bar')
                                 ->isActiveWhen(fn (): bool => request()->routeIs('filament.pages.top-visitor'))
                                  ->url(route('filament.pages.top-visitor')),

                                  // NavigationItem::make('Individual Reports')
                                  // ->icon('heroicon-o-document-report')
                                  // ->activeIcon('heroicon-s-document-report')
                                  // ->isActiveWhen(fn (): bool => request()->routeIs('filament.resources.students.individualReport'))
                                  // ->url(route('filament.resources.students.individualReport')),
                                ]),

                                NavigationGroup::make('QUEUES')
                        ->items([
                      ...TellerResource::getNavigationItems(),
                           ...QuequeResource::getNavigationItems(),

                        ]),
                    // NavigationGroup::make('Settings')
                    // ->items([
                    //     ...QuoteResource::getNavigationItems(),
                    // ]),


                ]);


        });
    }
}
