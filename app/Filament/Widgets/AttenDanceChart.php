<?php

namespace App\Filament\Widgets;

use App\Models\DayRecord;
use Illuminate\Support\Carbon;
use Filament\Widgets\BarChartWidget;

class AttenDanceChart extends BarChartWidget
{
    protected static ?string $heading = 'Month Record';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        return [

            'datasets' => [
                [
                    'label' => 'Student Who Go In Library Per Day',
                    'data' => DayRecord::withCount('daylogins')->get()->pluck('daylogins_count')->toArray(),
                ],
            ],
            'labels' =>  DayRecord::query() ->pluck('created_at')->map(function ($date) { return Carbon::parse($date)->format(' F j');}),
            // 'datasets' => [
            //     [
            //         'label' => 'Student Who Go In Library',
            //         'data' => DayRecord::withCount('daylogins')->get()->pluck('day_logins_count')->toArray(),
            //     ],
            // ],
            // 'labels' => DayRecord::query()->pluck('created_at')->map(fn ($date) => $date->format('M d')),
        ];
    }
}
