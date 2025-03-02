<?php

namespace Database\Factories;

use App\Models\Campus;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Student::class;
    public function definition(): array
    {
        return [
            'id_number' => $this->faker->unique()->regexify('[A-Za-z0-9]{20}'),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'middle_name' => $this->faker->lastName(),
            'sex' => 'Male',
            'contact_number'=>$this->faker->phoneNumber(10),
            'country'=> $this->faker->country(),
            'region'=> $this->faker->country(),
            'province'=> $this->faker->city(),
            'city' => $this->faker->city(),
            'barangay'=> $this->faker->city(),
            'street_address' => $this->faker->streetAddress(),
            'state'=>$this->faker->state(),
            'postal_code'=>$this->faker->postcode(),
            'campus_id'=> Campus::inRandomOrder()->first()->id,
            'course_id' => Course::inRandomOrder()->first()->id,
            'barcode'=>Str::random(10),
            'status'=>'single',
            'year'=>'1st Year',
            'profile'=>'',
            'school_id'=>'',
            'two_by_two'=>'',
        ];
    }
}
