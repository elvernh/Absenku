<?php

namespace Database\Factories;

use App\Models\ExcurVendor;
use App\Models\Meeting;
use App\Models\Status;
use App\Models\StudentExcurVendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presence>
 */
class PresenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $meeting = Meeting::all();
        $excvendor = ExcurVendor::all();
        $studentexcvendor = StudentExcurVendor::all();
        $status = Status::all();
        return [
            //
            'meeting_id' => $meeting->random()->id,
            'excur_vendor_id' => $excvendor->random()->id,
            'student_excur_vendor_id' => $studentexcvendor->random()->id,
            'keterangan' => $this->faker->sentence(5),
            'status_id' => $status->random()->id
        ];
    }
}
