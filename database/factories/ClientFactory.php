<?php

namespace Database\Factories;

use App\Models\Clientlient;
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
             'nome' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
              'morada' => fake()->address(),
              'localidade'=> fake()->city(),
              'telefone'=> fake()->phoneNumber(),

        ];
    }
}
