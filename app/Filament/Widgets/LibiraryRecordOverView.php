<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Campus;
use App\Models\Course;
use App\Models\Student;
use App\Models\DayLogin;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class LibiraryRecordOverView extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';
    protected static ?string $pollingInterval = '400ms';
    protected function getCards(): array
    {
        return [
            Card::make('System Accounts', User::query()->count()),
            Card::make('Students', Student::query()->count()),
            Card::make('Campuses', Campus::query()->count()),
            Card::make('Courses', Course::query()->count()),
            // Card::make('Daylogin', DayLogin::query()->latest()->count()),
        ];
    }
}
