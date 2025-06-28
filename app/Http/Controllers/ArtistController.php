<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::all();
        return view('artists.index', compact('artists'));
    }

    public function create()
    {
        return view('artists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Artist::create($request->only('name'));

        return redirect()->route('artists.index')->with('success', 'Artist created successfully!');
    }

    public function edit(Artist $artist)
    {
        return view('artists.edit', compact('artist'));
    }

    public function update(Requesr $request, Artist $artist)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $artist->update($request->only('name'));

        return redirect()->route('artists.index')->with('success', 'Artist updated successfully!');
    }

    public function destory(Artist $artist)
    {
        $artist->delete();

        return redirect()->route('artists.index')->with('success', 'Artist deleted successfully!');
    }
}
