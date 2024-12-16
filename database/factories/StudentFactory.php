<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Import Str untuk generate UUID

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
    public function definition(): array
    {
        $educationalLevel = $this->faker->randomElement(['SMP', 'SMA']);
        $grade = 0;
        $asal ='';
        if($educationalLevel == 'SMP') {
            $grade = $this->faker->randomElement(['7', '8', '9']);
            $asal = $this->faker->randomElement(range('a', 'j'));
        }else {
            $grade = $this->faker->randomElement(['10', '11', '12']);
            $asal = $this->faker->randomElement(['IPA 1', 'IPA 2', 'IPA 3', 'IPS 1', 'IPS 2', 'IPS 3']);
        }

        return [
            'full_name' => $this->faker->name(),
            'grade' => $grade,
            'educational_level' => $educationalLevel,
            'from_class' => $asal,
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password123'), 
            'token' => Str::uuid()
        ];
    }
}
