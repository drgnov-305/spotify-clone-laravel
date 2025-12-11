<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class AlbumSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $albums = [
            [
                'title' => 'Adore You',
                'artist' => 'Harry Styles',
                'cover' => 'adore-you-album.jpeg',
            ],
            [
                'title' => 'American Idiot',
                'artist' => 'Green Day',
                'cover' => 'american-idiot-album.jpg',
            ],
            [
                'title' => 'Purposes',
                'artist' => 'Justin Bieber',
                'cover' => 'purposes-album.png',
            ],
            [
                'title' => 'The 1975',
                'artist' => 'The 1975',
                'cover' => 'the-1975-album.jpg',
            ],
        ];

        foreach ($albums as $albumData) {
            // Get or create artist
            $artist = Artist::firstOrCreate(
                ['name' => $albumData['artist']],
                ['name' => $albumData['artist']]
            );

            // Copy image from images folder to public storage
            $sourcePath = public_path('../images/' . $albumData['cover']);
            $destinationPath = public_path('storage/albums/' . $albumData['cover']);

            if (File::exists($sourcePath)) {
                File::ensureDirectoryExists(public_path('storage/albums'));
                File::copy($sourcePath, $destinationPath);
            }

            // Create album
            Album::create([
                'artist_id' => $artist->id,
                'title' => $albumData['title'],
                'cover' => 'storage/albums/' . $albumData['cover'],
            ]);
        }
    }
}
