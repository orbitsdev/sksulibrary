<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Models\Student;
use Filament\Resources\Pages\Page;
use App\Filament\Resources\StudentResource;

class StudentDetails extends Page
{
    protected static string $resource = StudentResource::class;

    protected static string $view = 'filament.resources.student-resource.pages.student-details';

    public $student;
    public $reportType='student';



    public function mount($id){
    
        $this->student = Student::where('id',$id)->first();
       
    }

    public function printDetails()
    {
        $this->dispatchBrowserEvent('printStudentDetails');
    }




}
