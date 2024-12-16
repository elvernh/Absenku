<?php

namespace Database\Factories;

use App\Models\Extracurricular;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExcurVendor>
 */
class ExcurVendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $extracurriculars = Extracurricular::all(); 
        $vendors = Vendor::all(); 
        return [
            //
            'extracurricular_id' => $extracurriculars->random()->id,
            'vendor_id' =>  $vendors->random()->id,
            'semester' => $this->faker->randomElement([1, 2]),
            'academic_year' => $this->faker->year() . '/' . ($this->faker->year() + 1),
            'start_date' => $this->faker->date(),
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'pic' => $this->faker->name(),
            'day' => $this->faker->randomElement(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']),
            'fee' => $this->faker->numberBetween(100000, 1000000),
        ];
    }
}
