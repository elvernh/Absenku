<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Import Str untuk generate UUID

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('vendors')->insert([
            [
                'name' => 'Vendor A',
                'address' => 'Jl. Merpati No. 1',
                'phone' => '081234567890',
                'email' => 'vendora@example.com',
                'password' => bcrypt('password123'),
                'token' => Str::uuid(),
                'description' => 'Halo dari Vendor A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vendor B',
                'address' => 'Jl. Cendrawasih No. 2',
                'phone' => '081234567891',
                'email' => 'vendorb@example.com',
                'password' => bcrypt('password123'),
                'token' => Str::uuid(),
                'description' => 'Deskripsi singkat Vendor B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vendor C',
                'address' => 'Jl. Kenari No. 3',
                'phone' => '081234567892',
                'email' => 'vendorc@example.com',
                'password' => bcrypt('password123'),
                'token' => Str::uuid(),
                'description' => 'Vendor C adalah mitra kami.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vendor D',
                'address' => 'Jl. Rajawali No. 4',
                'phone' => '081234567893',
                'email' => 'vendord@example.com',
                'password' => bcrypt('password123'),
                'token' => Str::uuid(),
                'description' => 'Vendor D hadir untuk Anda.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vendor E',
                'address' => 'Jl. Garuda No. 5',
                'phone' => '081234567894',
                'email' => 'vendore@example.com',
                'password' => bcrypt('password123'),
                'token' => Str::uuid(),
                'description' => 'Deskripsi Vendor E.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vendor F',
                'address' => 'Jl. Elang No. 6',
                'phone' => '081234567895',
                'email' => 'vendorf@example.com',
                'password' => bcrypt('password123'),
                'token' => Str::uuid(),
                'description' => 'Halo, ini Vendor F.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
