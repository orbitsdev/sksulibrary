<?php

namespace Database\Factories;

use App\Models\Campus;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{


    protected $model = Course::class;
    /**
     * Define the model's default state.
     *
     * 
     * 
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'campus_id'=> Campus::inRandomOrder()->first()->id,
            'name'=> $this->faker->name(),
            'sub-name'=> $this->faker->name(),
        ];
    }
}
