@extends('layouts.app')

@section('content')
<div class="container mx-auto my-10">
    <h1 class="text-2xl font-bold mb-6">Genres List</h1>
    <a href="{{ route('genres.create') }}" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 mb-4 inline-block">
        Add Genre
    </a>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse ($genres as $genre)
            <div class="border rounded-lg shadow p-4">
                <h2 class="text-lg font-semibold">{{ $genre->name }}</h2>
            </div>
        @empty
            <p>No genres found.</p>
        @endforelse
    </div>
</div>
@endsection
