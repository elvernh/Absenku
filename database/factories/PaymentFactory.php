<?php

namespace Database\Factories;

use App\Models\StudentExcurVendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $student = StudentExcurVendor::all();
        return [
            //
            'student_excur_vendor_id' => $student->random()->id,
            'payment_date' => $this->faker->date(),
            'amount' => $this->faker->numberBetween(300000, 1000000),
            'transfer_url' => $this->faker->url(),
            'status_payment' => $this->faker->randomElement(['gagal', 'berhasil']),
            
        ];
    }
}
