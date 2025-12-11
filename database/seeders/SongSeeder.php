<?php

namespace Database\Seeders;

use App\Models\Song;
use App\Models\Album;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SongSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $songs = [
            [
                'title' => 'Adore You',
                'album' => 'Adore You',
                'file' => 'adore-you.mp3',
            ],
            [
                'title' => 'Love Yourself',
                'album' => 'Purposes',
                'file' => 'love-yourself.mp3',
            ],
            [
                'title' => 'American Idiot',
                'album' => 'American Idiot',
                'file' => 'american-idiot.mp3',
            ],
            [
                'title' => 'About You',
                'album' => 'The 1975',
                'file' => 'about-you.mp3',
            ],
        ];

        foreach ($songs as $songData) {
            // Get album
            $album = Album::where('title', $songData['album'])->first();

            if ($album) {
                // Copy song file from songs folder to public storage
                $sourcePath = public_path('../songs/' . $songData['file']);
                $destinationPath = public_path('storage/songs/' . $songData['file']);

                if (File::exists($sourcePath)) {
                    File::ensureDirectoryExists(public_path('storage/songs'));
                    File::copy($sourcePath, $destinationPath);
                }

                // Create song
                Song::create([
                    'album_id' => $album->id,
                    'title' => $songData['title'],
                    'file_url' => 'storage/songs/' . $songData['file'],
                ]);
            }
        }
    }
}
