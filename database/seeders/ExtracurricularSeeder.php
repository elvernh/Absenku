<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExtracurricularSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('extracurriculars')->insert([
            ['name' => 'Basketball', 'division' => 'SMP', 'level' => 'Inti', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Basketball', 'division' => 'SMP', 'level' => 'Reguler', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Basketball', 'division' => 'SMA', 'level' => 'Inti', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Basketball', 'division' => 'SMA', 'level' => 'Reguler', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Soccer', 'division' => 'SMP', 'level' => 'Inti', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Soccer', 'division' => 'SMP', 'level' => 'Reguler', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Soccer', 'division' => 'SMA', 'level' => 'Inti', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Soccer', 'division' => 'SMA', 'level' => 'Reguler', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Band', 'division' => 'SMP', 'level' => 'Inti', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Band', 'division' => 'SMP', 'level' => 'Reguler', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Band', 'division' => 'SMA', 'level' => 'Inti', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Band', 'division' => 'SMA', 'level' => 'Reguler', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Robotics', 'division' => 'SMP', 'level' => 'Inti', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Robotics', 'division' => 'SMP', 'level' => 'Reguler', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Robotics', 'division' => 'SMA', 'level' => 'Inti', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Robotics', 'division' => 'SMA', 'level' => 'Reguler', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Dance', 'division' => 'SMP', 'level' => 'Inti', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dance', 'division' => 'SMP', 'level' => 'Reguler', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dance', 'division' => 'SMA', 'level' => 'Inti', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dance', 'division' => 'SMA', 'level' => 'Reguler', 'created_at' => now(), 'updated_at' => now()]

        ]);
    }
}
