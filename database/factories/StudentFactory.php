<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

class StudentFactory extends Factory
{
    protected $currentNum = 1;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $school_id = rand(1, 10);
        
        return [
            'name' => $this->faker->name,
            'school_id' => $school_id,
            'order' => $this->currentNum++,
        ];
    }
}
