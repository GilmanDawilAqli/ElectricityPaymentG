<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelanggan>
 */
class PelangganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'NoKontrol' => $this->faker->unique()->numberBetween(1, 100000),
            'nama' => $this->faker->name(),
            'telepon' => $this->faker->phoneNumber(),
            'Jenis_Plg' => $this->faker->randomElement(['R1/TR', 'R2/TR', 'B1/TR']),
            'alamat' => $this->faker->address(),
        ];
    }
}
