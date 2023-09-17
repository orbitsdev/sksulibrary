<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Campus;
use App\Models\Course;
use App\Models\Student;
use App\Models\DayLogin;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class LibiraryRecordOverView extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';
    protected static ?string $pollingInterval = '400ms';

    
    // public function setStatusFilter(){
    //     dd('dasd');
    // }
    protected function getCards(): array
    {
        return [
            Card::make('System Accounts', User::query()->count())
            ->extraAttributes([
                'class' => 'cursor-pointer',
                'wire:click' => '$emitUp("setStatusFilter", "processed")',
            ]),
            Card::make('Total Students', Student::query()->count()),
            Card::make('Total Visitors',  DayLogin::whereHas('logout', function ($query) {
                $query->where('status', 'Logged out');
            })
            ->groupBy('student_id')
            ->select('student_id')
            ->get()
            ->count()),
            Card::make('Total Courses', Course::query()->count()), 
            // Card::make('Daylogin', DayLogin::query()->latest()->count()),
        ];
    }
}
