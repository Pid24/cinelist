<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run()
    {
        $genres = ['Action', 'Adventure', 'Drama', 'Komedi', 'Horor', 'Romance', 'Sci-Fi', 'Sports'];

        foreach ($genres as $genre) {
            Genre::firstOrCreate(['name' => $genre]);
        }
    }
}
