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
    public ?string $filter = null;


    public function __construct(){
        $this->filter = now()->format('m');
    }
    protected static ?array $options = [
        'scales' => [
            'y' => [
                'beginAtZero' => true, // Start the Y-axis at zero
                'ticks' => [
                    'precision' => 0, // Set the number of decimal places to 0
                ],
            ],
        ],
        'plugins' => [
            'legend' => [
                'display' => true, // Display the legend
                'position' => 'left', // You can adjust the position (options: top, bottom, left, right)
            ],
            'tooltip' => [
                'enabled' => true,
            ],
            'datalabels' => [
                'display' => true, // Enable datalabels
                'align' => 'end',
                'anchor' => 'end',
                'formatter' => 'function(value, context) { return value; }',
                'color' => '#000',
                'font' => [
                    'size' => 12,
                ],
                'offset' => 4,
            ],
        ],
    ];

    // protected function getData(): array
    // {

    //     $data = DB::table('day_records')
    //     ->join('day_logins', 'day_records.id', '=', 'day_logins.day_record_id')
    //     ->join('students', 'day_logins.student_id', '=', 'students.id')
    //     ->join('courses', 'students.course_id', '=', 'courses.id')
    //     ->select(
    //         'day_records.created_at as day_date',
    //         'courses.name as course_name',
    //         DB::raw('COUNT(DISTINCT students.id) as student_count')
    //     )
    //     ->whereYear('day_records.created_at', '=', Carbon::now()->year)
    //     ->whereMonth('day_records.created_at', '=', Carbon::now()->month)
    //     ->groupBy('day_records.created_at', 'courses.name')
    //     ->get();

    // $result = [];
    // $labels = [];

    // foreach ($data as $item) {
    //     $dayDate = Carbon::parse($item->day_date)->format('Y-m-d');
    //     $courseName = $item->course_name;
    //     $studentCount = $item->student_count;

    //     if (!isset($result[$dayDate])) {
    //         $result[$dayDate] = [];
    //     }

    //     $result[$dayDate][$courseName] = $studentCount;

    //     if (!in_array($courseName, $labels)) {
    //         $labels[] = $courseName;
    //     }
    // }

    // $datasets = [];
    // foreach ($result as $dayDate => $courseData) {
    //     $data = [];
    //     foreach ($labels as $courseName) {
    //         $data[] = $courseData[$courseName] ?? 0;
    //     }

    //     $datasets[] = [
    //         'backgroundColor' => '#0CE461',
    //         'label' => $dayDate,
    //         'data' => $data,
    //     ];
    // }

    // return [
    //     'labels' => $labels,
    //     'datasets' => $datasets,
    //     'legend' => [
    //         'display' => true,
    //         'position' => 'top',
    //     ],
    // ];
       

    // }
    protected function getData(): array
    {   

        $selectedMonth = $this->filter;
        $data = DB::table('day_records')
        ->join('day_logins', 'day_records.id', '=', 'day_logins.day_record_id')
        ->join('students', 'day_logins.student_id', '=', 'students.id')
        ->join('courses', 'students.course_id', '=', 'courses.id')
        ->select(
            'day_records.created_at as day_date',
            'courses.name as course_name',
            DB::raw('COUNT(DISTINCT students.id) as student_count')
        )
        ->whereYear('day_records.created_at', '=', Carbon::now()->year)
        ->whereMonth('day_records.created_at', '=', $selectedMonth) // Filter by the selected month
        ->groupBy('day_date', 'course_name')
        ->get();
    
        $result = [];
        $labels = [];
        $courseColors = [];
    
        foreach ($data as $item) {
            $dayDate = Carbon::parse($item->day_date)->format('Y-m-d');
            $courseName = $item->course_name;
            $studentCount = (int)$item->student_count;
    
            if (!in_array($dayDate, $labels)) {
                $labels[] = $dayDate;
            }
    
            if (!isset($result[$courseName])) {
                $result[$courseName] = [];
            }
    
            $result[$courseName][$dayDate] = $studentCount;
    
            if (!array_key_exists($courseName, $courseColors)) {
                // Assign a distinct color to each course
                $courseColors[$courseName] = '#' . substr(md5($courseName), 0, 6);
            }
        }
    
        $datasets = [];
        foreach ($result as $courseName => $courseData) {
            $data = [];
            foreach ($labels as $dayDate) {
                $data[] = $courseData[$dayDate] ?? 0;
            }
    
            $datasets[] = [
                'backgroundColor' => $courseColors[$courseName],
                'label' => $courseName,
                'data' => $data,
            ];
        }
    
        return [

            // 'plugins' => [
            //     'legend' => [
            //         'display' => true, // Display the legend
            //         'position' => 'top', // You can adjust the position (options: top, bottom, left, right)
            //     ],
            //     'tooltip' => [
            //         'enabled' => true,
            //     ],
            //     'datalabels' => [
            //         'display' => true, // Enable datalabels
            //         'align' => 'end',
            //         'anchor' => 'end',
            //         'formatter' => 'function(value, context) { return value; }',
            //         'color' => '#000',
            //         'font' => [
            //             'size' => 12,
            //         ],
            //         'offset' => 4,
            //     ],
            // ],
            'labels' => $labels,
            'datasets' => $datasets,
            'legend' => [
                'display' => true,
                'position' => 'top',
            ],
        ];
    }
    protected function getFilters(): ?array
    {
        $filters = [];
        
        // Generate options for each month
        for ($month = 1; $month <= 12; $month++) {
            $monthName = Carbon::create(null, $month)->format('F');
            $monthValue = Carbon::create(null, $month)->format('m');
            $filters[$monthValue] = $monthName;
        }
    
        // Set the default filter to the current month
        $currentMonth = now()->format('m');
        $filters[$currentMonth] = Carbon::now()->format('F');
    
        return $filters;
    }
    

    
    
}
