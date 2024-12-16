<?php

namespace Database\Factories;

use App\Models\ExcurVendor;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentExcurVendor>
 */
class StudentExcurVendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $extracurriculars = ExcurVendor::all(); 
        $vendors = Vendor::all(); 
        return [
            //
            'excur_vendor_id' => $extracurriculars->random()->id,
            'student_id' => $vendors->random()->id,
            'score_mid' => $this->faker->numberBetween(1, 100),
            'score_final' => $this->faker->numberBetween(1, 100),
            'url_certificate' => $this->faker->url(),
            'note' => $this->faker->sentence(5),
            'bill' => $this->faker->numberBetween(1000000, 1100000)
        ];
    }
}
