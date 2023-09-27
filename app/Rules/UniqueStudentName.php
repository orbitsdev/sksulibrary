<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueStudentName implements ValidationRule
{

   public $first_name;
   public $last_name;
   public $id_number;

    public function __construct($first_name, $last_name)
    {

        $this->first_name = $first_name;
        $this->last_name = $last_name;


    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {


        $existingRecord = DB::table('students')
        ->where('last_name', $this->last_name)
        ->where('first_name', $this->first_name)
        // ->orWhere('id_number', $this->id_number)
        // ->where('id_number', $value)
        ->first();



        
        if ($existingRecord) {
            
            $fail('A similar record already exists. Are you sure you want to create it forcefully');
        }
        
    }
}
