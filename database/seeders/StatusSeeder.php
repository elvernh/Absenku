<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('statuses')->insert([
            ['status_name' => 'hadir'],
            ['status_name' => 'terlambat'],
            ['status_name' => 'izin'],
            ['status_name' => 'tidak hadir'],

        ]);
    }
}
