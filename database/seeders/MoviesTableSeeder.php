<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MoviesTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('movies')->insert([
                'title' => $faker->sentence(3), // Título de 3 palabras
                'synopsis' => $faker->paragraph, // Una sinopsis generada
                'year' => $faker->year, // Año aleatorio
                'cover' => $faker->imageUrl(640, 480, 'movies', true, 'cover') // URL de una imagen aleatoria
            ]);
        }
    }
}
