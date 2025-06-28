@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Artists</h1>
        <a href="{{ route('artists.create') }}" class="btn btn-primary">Add Artist</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Albums</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($artists as $artist)
            <tr>
                <td>{{ $artist->name }}</td>
                <td>{{ $artist->albums->count() }}</td>
                <td>
                    <a href="{{ route('artists.edit', $artist) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('artists.destroy', $artist) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete artist?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection