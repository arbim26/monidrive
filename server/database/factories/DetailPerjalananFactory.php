<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Perjalanan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailPerjalanan>
 */
class DetailPerjalananFactory extends Factory
{
    public function definition(): array
    {
        return [
            'perjalanan_id' => Perjalanan::factory(),
            'lokasi' => $this->faker->latitude() . ',' . $this->faker->longitude(),
            'kecepatan' => $this->faker->numberBetween(0, 120),
            'status_kendaraan' => $this->faker->randomElement(['berjalan', 'berhenti', 'macet']),
            'waktu' => now(),
        ];
    }
}
