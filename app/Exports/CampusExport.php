<?php

namespace App\Exports;

use App\Models\Campus;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class CampusExport implements FromView
{
    public function view(): View
    {
        return view('exports.campuses', [
            'items' => Campus::all()
        ]);
    }
}
