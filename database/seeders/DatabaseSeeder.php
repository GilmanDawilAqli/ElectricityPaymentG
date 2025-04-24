<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ── Admin user ───────────────────────────────────────────
        User::factory()->create([
            'name'     => 'Gilman',
            'email'    => 'gilman@example.com',
            'password' => Hash::make('12345678'),   // hash password!
            'admin'    => true,
        ]);

        // ── Regular user ─────────────────────────────────────────
        User::factory()->create([
            'name'     => 'Pengguna Biasa',
            'email'    => 'user@example.com',
            'password' => Hash::make('12345678'),
            'admin'    => false,
        ]);
    }
}
