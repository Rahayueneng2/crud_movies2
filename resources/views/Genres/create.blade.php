@extends('layouts.app')

@section('content')
<div class="container mx-auto my-10">
    <h1 class="text-2xl font-bold mb-6">Add New Genre</h1>
    <form action="{{ route('genres.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Genre Name:</label>
            <input type="text" id="name" name="name" class="w-full border-gray-300 rounded-lg" required>
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
            Add Genre
        </button>
    </form>
</div>
@endsection
