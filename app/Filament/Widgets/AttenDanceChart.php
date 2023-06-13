<?php

namespace App\Filament\Widgets;

use App\Models\DayRecord;
use Illuminate\Support\Carbon;
use Filament\Widgets\BarChartWidget;

class AttenDanceChart extends BarChartWidget
{
    protected static ?string $heading = 'Login Per Day';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {

        

        $currentMonth = Carbon::now()->format('Y-m');

        return [
            'datasets' => [
                [
                    'backgroundColor' => '#0CE461',
                    'label' => 'Student Who Go In Library Per Day',
                    'data' => DayRecord::whereYear('created_at', '=', Carbon::now()->year)
                        ->whereMonth('created_at', '=', Carbon::now()->month)
                        ->withCount('daylogins')
                        ->get()
                        ->pluck('daylogins_count')
                        ->toArray(),
                ],
            ],
            'labels' => DayRecord::whereYear('created_at', '=', Carbon::now()->year)
                ->whereMonth('created_at', '=', Carbon::now()->month)
                ->pluck('created_at')
                ->map(function ($date) {
                    return Carbon::parse($date)->format('F j');
                })
                ->toArray(),
        ];

        // return [
           
        //     'datasets' => [
        //         [
        //             'backgroundColor' => '#0CE461',
        //             'label' => 'Student Who Go In Library Per Day',
        //             'data' => DayRecord::withCount('daylogins')->get()->pluck('daylogins_count')->toArray(),
        //         ],
        //     ],
        //     'labels' =>  DayRecord::query() ->pluck('created_at')->map(function ($date) { return Carbon::parse($date)->format(' F j');}),
         
        // ];
    }
}
