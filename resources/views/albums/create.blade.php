@extends('layouts.app')

@section('content')
    <h1>Add Album</h1>
    <form action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" class="form-control" value="{{ old('title') }}" required>
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Artist</label>
            <select name="artist_id" class="form-control" required>
                <option value="">-- Select Artist --</option>
                @foreach ($artists as $artist)
                    <option value="{{ $artist->id }}" {{ old('artist_id') == $artist->id ? 'selected' : '' }}>{{ $artist->name }}</option>
                @endforeach
            </select>
            @error('artist_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Cover</label>
            <input type="file" name="cover" class="form-control">
            @error('cover')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <button class="btn btn-primary">Save</button>
        <a href="{{ route('albums.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection