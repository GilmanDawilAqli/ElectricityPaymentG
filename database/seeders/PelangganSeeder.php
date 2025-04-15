<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pelanggan')->insert([
            [
                'NoKontrol' => '123456789012',
                'Nama' => 'John Doe',
                'Alamat' => 'Jl. Merdeka No. 1',
                'Telepon' => '081234567890',
                'JenisPelanggan' => 'R1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'NoKontrol' => '987654321098',
                'Nama' => 'Jane Smith',
                'Alamat' => 'Jl. Sudirman No. 2',
                'Telepon' => '081298765432',
                'JenisPelanggan' => 'R2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}