<?php

namespace Database\Seeders;

use App\Models\Artist;
use Illuminate\Database\Seeder;

class ArtistSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $artists = [
            'Harry Styles',
            'Green Day',
            'Justin Bieber',
            'The 1975',
        ];

        foreach ($artists as $artistName) {
            Artist::firstOrCreate(
                ['name' => $artistName],
                ['name' => $artistName]
            );
        }
    }
}
