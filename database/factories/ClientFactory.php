<?php

namespace Database\Factories;

use App\Models\client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
             'nome' => fake()->nome(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
              'morada' => fake()->address(),
              'localidade'=> fake()->city(),
              'telefone'=> fake()->phoneNumber(),

        ];
    }
}
