@extends('Layouts.index')

@section('content')
<section class="container my-24 mx-auto">
  <form action="{{ route('movies.update', $movie->id) }}" method="POST"
    class="max-w-4xl mx-auto bg-blue-50 rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 p-5">
    @csrf
    @method('PUT')

    <!-- Title -->
    <div class="mb-6">
      <label for="title" class="block text-lg font-medium text-gray-700">Title:</label>
      <input type="text" id="title" name="title" class="w-full p-3 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
        value="{{ old('title', $movie->title) }}" required>
      @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>

    <!-- Synopsis -->
    <div class="mb-6">
      <label for="synopsis" class="block text-lg font-medium text-gray-700">Synopsis:</label>
      <textarea id="synopsis" name="synopsis" class="w-full p-3 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" required>{{ old('synopsis', $movie->synopsis) }}</textarea>
      @error('synopsis')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>

    <!-- Poster URL -->
    <div class="mb-6">
      <label for="poster" class="block text-lg font-medium text-gray-700">Poster URL:</label>
      <input type="text" id="poster" name="poster" class="w-full p-3 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
        value="{{ old('poster', $movie->poster) }}">
      @error('poster')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>

    <!-- Year -->
    <div class="mb-6">
      <label for="year" class="block text-lg font-medium text-gray-700">Year:</label>
      <input type="text" id="year" name="year" class="w-full p-3 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
        value="{{ old('year', $movie->year) }}" required>
      @error('year')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>

    <!-- Available -->
    <div class="mb-6">
      <label for="available" class="block text-lg font-medium text-gray-700">Available:</label>
      <select id="available" name="available" class="w-full p-3 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <option value="1" {{ old('available', $movie->available) == '1' ? 'selected' : '' }}>Yes</option>
        <option value="0" {{ old('available', $movie->available) == '0' ? 'selected' : '' }}>No</option>
      </select>
      @error('available')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>

    <!-- Genre -->
    <div class="mb-6">
      <label for="genre_id" class="block text-lg font-medium text-gray-700">Genre:</label>
      <select id="genre_id" name="genre_id" class="w-full p-3 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <option value="" disabled {{ old('genre_id', $movie->genre_id) ? '' : 'selected' }}>Select Genre</option>
        @if($genres->isEmpty())
          <option value="">No genres available</option>
        @else
          @foreach ($genres as $genre)
            <option value="{{ $genre->id }}" {{ old('genre_id', $movie->genre_id) == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
          @endforeach
        @endif
      </select>
      @error('genre_id')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>

    <!-- Submit Button -->
    <button type="submit"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
  </form>
</section>
@endsection
