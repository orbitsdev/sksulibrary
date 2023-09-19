<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class TopVisitorExport implements  FromView
{   


    public $records;

    public function __construct($records){
        $this->records = $records;
    }
    public function view(): View
    {   

      
        return view('exports.top-visitors', [
            'collections' => $this->records,
        ]);
    }

}
