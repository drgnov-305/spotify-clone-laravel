<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Album;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function index()
    {
        $songs = Song::with('album.artist')->get();
        return view('songs.index', compact('songs'));
    }

    public function create()
    {
        $albums = Album::with('artist')->get();
        return view('songs.create', compact('albums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'album_id' => 'required|exists:albums,id',
            'title' => 'required|string|max:255',
            'file_url' => 'required|file|mimes:mp3,wav,ogg|max:10240',
        ]);

        $data = $request->only(['album_id', 'title']);
        if ($request->hasFile('file_url')) {
            $data['file_url'] = $request->file('file_url')->store('songs', 'public');
        }

        Song::create($data);

        return redirect()->route('songs.index')->with('success', 'Song created successfully!');
    }

    public function edit(Song $song)
    {
        $albums = Album::with('artist')->get();
        return view('songs.edit', compact('song', 'albums'));
    }

    public function update(Request $request, Song $song)
    {
        $request->validate([
            'album_id' => 'required|exists:albums,id',
            'title' => 'required|string|max:255',
            'file_url' => 'nullable|file|mimes:mp3,wav,ogg|max:10240',
        ]);

        $data = $request->only(['album_id', 'title']);
        if ($request->hasFile('file_url')) {
            $data['file_url'] = $request->file('file_url')->store('songs', 'public');
        }

        $song->update($data);

        return redirect()->route('songs.index')->with('success', 'Song updated successfully!');
    }

    public function destroy(Song $song)
    {
        $song->delete();

        return redirect()->route('songs.index')->with('success', 'Song deleted successfully!');
    }
}