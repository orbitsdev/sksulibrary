<?php

namespace App\Filament\Widgets;

use App\Models\DayRecord;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\BarChartWidget;

class AttenDanceChart extends BarChartWidget
{
    protected static ?string $heading = 'Monthly Report Daily Visitors by Course';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    

        protected function getData(): array
        {
            // Get the data using a raw SQL query
            $data = DB::table('day_records')
                ->join('day_logins', 'day_records.id', '=', 'day_logins.day_record_id')
                ->join('students', 'day_logins.student_id', '=', 'students.id')
                ->join('courses', 'students.course_id', '=', 'courses.id')
                ->select('courses.name as course_name', DB::raw('COUNT(day_logins.id) as login_count'))
                ->whereYear('day_records.created_at', '=', Carbon::now()->year)
                ->whereMonth('day_records.created_at', '=', Carbon::now()->month)
                ->groupBy('courses.name')
                ->get();
    
            $labels = $data->pluck('course_name')->toArray();
            $loginCounts = $data->pluck('login_count')->toArray();
    
            return [
                'datasets' => [
                    [
                        'backgroundColor' => '#0CE461',
                        'label' => 'Number Of Students Visited Per Course',
                        'data' => $loginCounts,
                    ],
                ],
                'labels' => $labels,
            ];
        }

       
    
}
