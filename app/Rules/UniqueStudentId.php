<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueStudentId implements ValidationRule
{

   
    private $id_number;
 
     public function __construct($id_number)
     {
 
         $this->id_number = $id_number;
 
     }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $existingRecord = DB::table('students')->where('id_number', $this->id_number)->first();


        if ($existingRecord) {
            $fail('A similar id already exists');
        }
    }
}
