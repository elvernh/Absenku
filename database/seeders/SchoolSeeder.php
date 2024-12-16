<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Import Str untuk generate UUID

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('schools')->insert(
            [
                'name' => 'Sekolah Suzuran',
                'email' => 'suzuran@email.com',
                'password' => bcrypt('pwd123'),
                'token' => Str::uuid(), 
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
}
