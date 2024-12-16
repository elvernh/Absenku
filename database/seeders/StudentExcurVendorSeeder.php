<?php

namespace Database\Seeders;

use App\Models\StudentExcurVendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentExcurVendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        StudentExcurVendor::factory(150)->create();
    }
}
