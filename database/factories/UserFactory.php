<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'alamat' => Str::random(20),
            'no_hp' => rand(000000000000,999999999999),
            'tentang'=>  Str::random(20),
            'tgl_lahir'=> Str::random(),
            'tempat_lahir'=> Str::random(),
            'img_profile'=> Str::random(),
            'password'=> bcrypt('secret'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
