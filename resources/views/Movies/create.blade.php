@extends('layouts.index')

@section('content')
<div class="container mx-auto my-10">
    <h1 class="text-3xl font-extrabold text-center mb-6">Add New Movie</h1>
    <form action="{{ route('movies.store') }}" method="POST" class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8" enctype="multipart/form-data">
        @csrf

        <!-- Title -->
        <div class="mb-6">
            <label for="title" class="block text-lg font-medium text-gray-700">Title:</label>
            <input type="text" id="title" name="title" class="w-full p-3 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('title') }}" required>
            @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Synopsis -->
        <div class="mb-6">
            <label for="synopsis" class="block text-lg font-medium text-gray-700">Synopsis:</label>
            <textarea id="synopsis" name="synopsis" class="w-full p-3 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" required>{{ old('synopsis') }}</textarea>
            @error('synopsis')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        <!-- Poster (File Input) -->
        <div class="mb-6">
            <label for="poster" class="block text-lg font-medium text-gray-700">Poster:</label>
            <label for="poster-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                <div class="flex flex-col items-center justify-center pt-5 pb-6 relative">
                    <!-- Container for preview -->
                    <div id="image-preview-container" class="mb-4 hidden w-full h-full bg-red-200 absolute z-50">
                        <img id="image-preview" class="h-full w-full object-cover rounded-md" alt="Poster Preview" />
                    </div>
                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                    </svg>
                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                    <p class="text-xs text-gray-500">SVG, PNG, JPG, or GIF (MAX. 2MB)</p>
                </div>
                <input id="poster-file" name="poster" type="file" class="hidden" accept="image/*" />
            </label>

        <!-- Year -->
        <div class="mb-6">
            <label for="year" class="block text-lg font-medium text-gray-700">Year:</label>
            <input type="text" id="year" name="year" class="w-full p-3 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('year') }}" required>
            @error('year')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Available -->
        <div class="mb-6">
            <label for="available" class="block text-lg font-medium text-gray-700">Available:</label>
            <select id="available" name="available" class="w-full p-3 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="1" {{ old('available') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('available') == '0' ? 'selected' : '' }}>No</option>
            </select>
            @error('available')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Genre -->
        <div class="mb-6">
            <label for="genre_id" class="block text-lg font-medium text-gray-700">Genre:</label>
            <select id="genre_id" name="genre_id" class="w-full p-3 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="" disabled {{ old('genre_id') ? '' : 'selected' }}>Select Genre</option>
                @if($genres->isEmpty())
                    <option value="">No genres available</option>
                @else
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
                    @endforeach
                @endif
            </select>
            @error('genre_id')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full p-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Add Movie
        </button>
    </form>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle poster file input change
    document.getElementById('poster-file').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('image-preview-container');
        const previewImage = document.getElementById('image-preview');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
            };

            reader.readAsDataURL(file);
        } else {
            previewContainer.classList.add('hidden');
            previewImage.src = '';
        }
    });
});
</script>