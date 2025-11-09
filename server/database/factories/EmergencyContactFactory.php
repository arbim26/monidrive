<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\EloquentFactories\Factory<\App\Models\EmergencyContact>
 */
class EmergencyContactFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'nama_kontak' => $this->faker->name(),
            'nomor_telepon' => $this->faker->phoneNumber(),
            'hubungan' => $this->faker->randomElement(['ibu', 'ayah', 'teman', 'rekan kerja']),
        ];
    }
}
