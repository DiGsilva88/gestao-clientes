<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Client;
use App\Models\Categoria;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(10)->create();

        Client::factory(10)->create();

        Categoria::create([
            'categoria' => 'Consumiveis',
        ]);

        Categoria::create([
            'categoria' => 'Roupas',
        ]);

        Categoria::create([
            'categoria' => 'Alimentos',
        ]);

        Categoria::create([
            'categoria' => 'Móveis',
        ]);

        Categoria::create([
            'categoria' => 'Livros',
        ]);

                // User::factory(10)->create();

    }
}





