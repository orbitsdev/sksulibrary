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
        $campusData = Campus::all();
        
        if ($campusData->isEmpty()) {

            $campusData = [
                (object) [
                    'name' => 'Isulan',
                    'id' => 1, // Replace with the appropriate campus_id
                ],
                (object) [
                    'name' => 'Access',
                    'id' => 2, // Replace with the appropriate campus_id
                ],
                (object) [
                    'name' => 'Tacurong',
                    'id' => 3, // Replace with the appropriate campus_id
                ],
                // Add more default courses as objects as needed
            ];

        }

        return view('exports.campuses', [
            'items' => $campusData
        ]);
    }
}
