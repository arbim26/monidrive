<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\EloquentFactories\Factory<\App\Models\Perjalanan>
 */
class PerjalananFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'tujuan' => $this->faker->city(),
            'lokasi_awal' => $this->faker->latitude() . ',' . $this->faker->longitude(),
            'lokasi_akhir' => $this->faker->latitude() . ',' . $this->faker->longitude(),
            'status' => $this->faker->randomElement(['aktif', 'selesai', 'batal']),
        ];
    }
}
