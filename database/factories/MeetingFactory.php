<?php

namespace Database\Factories;

use App\Models\ExcurVendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meeting>
 */
class MeetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $excur = ExcurVendor::all();
        return [
            //
            'excur_vendor_id' =>$excur->random()->id,
            'meeting_date' => $this->faker->date(),
            'topic' => $this->faker->sentence(6),
            'teacher' => $this->faker->name()

        ];
    }
}
