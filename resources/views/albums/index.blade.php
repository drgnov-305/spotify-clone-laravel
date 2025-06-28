@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Albums</h1>
        <a href="{{ route('albums.create') }}" class="btn btn-primary">Add Album</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Cover</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($albums as $album)
            <tr>
                <td>{{ $album->title }}</td>
                <td>{{ $album->artist->name }}</td>
                <td>
                    @if($album->cover)
                        <img src="{{ asset('storage/'.$album->cover) }}" alt="cover" width="50">
                    @endif
                </td>
                <td>
                    <a href="{{ route('albums.edit', $album) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('albums.destroy', $album) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete album?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection