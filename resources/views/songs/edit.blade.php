@extends('layouts.app')

@section('content')
    <h1>Edit Song</h1>
    <form action="{{ route('songs.update', $song) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" class="form-control" value="{{ old('title', $song->title) }}" required>
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Album</label>
            <select name="album_id" class="form-control" required>
                @foreach ($albums as $album)
                    <option value="{{ $album->id }}" {{ old('album_id', $song->album_id) == $album->id ? 'selected' : '' }}>
                        {{ $album->title }} ({{ $album->artist->name }})
                    </option>
                @endforeach
            </select>
            @error('album_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">File (mp3/wav/ogg)</label>
            <input type="file" name="file_url" class="form-control">
            @if($song->file_url)
                <div class="mt-2">
                    <audio controls style="width:100px;">
                        <source src="{{ asset('storage/'.$song->file_url) }}">
                    </audio>
                </div>
            @endif
            @error('file_url')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('songs.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection