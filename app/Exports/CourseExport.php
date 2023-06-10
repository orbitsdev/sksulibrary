<?php

namespace App\Exports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class CourseExport implements FromView {
 
    public function view(): View
    {
        return view('exports.courses', [
            'items' => Course::all()
        ]);
    }
}
