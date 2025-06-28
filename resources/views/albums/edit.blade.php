@extends('layouts.app')

@section('content')
    <h1>Edit Album</h1>
    <form action="{{ route('albums.update', $album) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" class="form-control" value="{{ old('title', $album->title) }}" required>
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Artist</label>
            <select name="artist_id" class="form-control" required>
                @foreach ($artists as $artist)
                    <option value="{{ $artist->id }}" {{ old('artist_id', $album->artist_id) == $artist->id ? 'selected' : '' }}>{{ $artist->name }}</option>
                @endforeach
            </select>
            @error('artist_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Cover</label>
            @if($album->cover)
                <div><img src="{{ asset('storage/'.$album->cover) }}" width="80"></div>
            @endif
            <input type="file" name="cover" class="form-control mt-2">
            @error('cover')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('albums.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection