@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Songs</h1>
        <a href="{{ route('songs.create') }}" class="btn btn-primary">Add Song</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Album</th>
                <th>Artist</th>
                <th>Audio</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($songs as $song)
            <tr>
                <td>{{ $song->title }}</td>
                <td>{{ $song->album->title }}</td>
                <td>{{ $song->album->artist->name }}</td>
                <td>
                    <audio controls style="width:100px;">
                        <source src="{{ asset('storage/'.$song->file_url) }}">
                    </audio>
                </td>
                <td>
                    <a href="{{ route('songs.edit', $song) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('songs.destroy', $song) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete song?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection