<?php

namespace Database\Seeders;

use App\Models\ExcurVendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExcurVendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExcurVendor::factory(15)->create();
    }
}
