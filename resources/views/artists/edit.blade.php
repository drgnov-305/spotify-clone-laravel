@extends('layouts.app')

@section('content')
    <h1>Edit Artist</h1>
    <form action="{{ route('artists.update', $artist) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" class="form-control" value="{{ old('name', $artist->name) }}" required>
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('artists.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection