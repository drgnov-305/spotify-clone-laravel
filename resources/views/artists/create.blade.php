@extends('layouts.app')

@section('content')
    <h1>Add Artist</h1>
    <form action="{{ route('artists.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <button class="btn btn-primary">Save</button>
        <a href="{{ route('artists.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection