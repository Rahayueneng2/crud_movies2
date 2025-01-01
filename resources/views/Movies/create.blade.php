@extends('layouts.index')

@section('content')
<div class="container mx-auto my-10">
    <h1 class="text-2xl font-bold mb-6">Add New Movie</h1>
    <form action="{{ route('movies.store') }}" method="POST">
        @csrf

        <!-- Title -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium">Title:</label>
            <input type="text" id="title" name="title" class="w-full border-gray-300 rounded-lg" value="{{ old('title') }}" required>
            @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Synopsis -->
        <div class="mb-4">
            <label for="synopsis" class="block text-sm font-medium">Synopsis:</label>
            <textarea id="synopsis" name="synopsis" class="w-full border-gray-300 rounded-lg" rows="4" required>{{ old('synopsis') }}</textarea>
            @error('synopsis')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Poster -->
        <div class="mb-4">
            <label for="poster" class="block text-sm font-medium">Poster URL:</label>
            <input type="text" id="poster" name="poster" class="w-full border-gray-300 rounded-lg" value="{{ old('poster') }}">
            @error('poster')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Year -->
        <div class="mb-4">
            <label for="year" class="block text-sm font-medium">Year:</label>
            <input type="text" id="year" name="year" class="w-full border-gray-300 rounded-lg" value="{{ old('year') }}" required>
            @error('year')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Available -->
        <div class="mb-4">
            <label for="available" class="block text-sm font-medium">Available:</label>
            <select id="available" name="available" class="w-full border-gray-300 rounded-lg" required>
                <option value="1" {{ old('available') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('available') == '0' ? 'selected' : '' }}>No</option>
            </select>
            @error('available')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Genre -->
        <div class="mb-4">
    <label for="genre_id" class="block text-sm font-medium">Genre:</label>
    <select id="genre_id" name="genre_id" class="w-full border-gray-300 rounded-lg" required>
        <option value="" disabled {{ old('genre_id') ? '' : 'selected' }}>Select Genre</option>
        @if($genres->isEmpty())
            <option value="">No genres available</option>
        @else
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                    {{ $genre->name }}
                </option>
            @endforeach
        @endif
    </select>
    @error('genre_id')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
</div>


        <!-- Submit Button -->
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
            Add Movie
        </button>
    </form>
</div>
@endsection
