<?php

namespace App\Providers;

use App\Models\Campus;
use App\Models\DayLogin;
use App\Models\DayRecord;
use App\Models\Queque;
use App\Models\Student;
use App\Observers\CampusObserver;
use App\Observers\DayRecordObserver;
use App\Observers\LoginObserver;
use App\Observers\QuequeObserver;
use App\Observers\StudentObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Queque::observe(QuequeObserver::class);
        Campus::observe(CampusObserver::class);
        Student::observe(StudentObserver::class);
        DayRecord::observe(DayRecordObserver::class);
        DayLogin::observe(LoginObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
