@extends('Layouts.index')

@section('content')
<section class="container my-24 mx-auto">
@forelse ($movies as $movie)
    <div class="relative">
      <a href="#">
        <img class="h-auto max-w-full rounded-lg" src="{{ $movie->poster ?? 'https://flowbite.s3.amazonaws.com/docs/gallery/square/image.jpg' }}" alt="{{ $movie->title }}">
      </a>
      <div class="absolute top-0 flex justify-between w-full">
        <p class="bg-white px-3 py-2 rounded-br-lg text-lg">{{ $movie->created_at->translatedFormat('d F Y') }}</p>
        <p class="bg-white px-3 py-2 rounded-bl-lg text-lg">{{ $movie->genre->name ?? 'No Genre' }}</p>
      </div>
      <div class="py-2">
        <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $movie->title }}</h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">{{ Str::limit($movie->synopsis, 120) }}</p>
      </div>
    </div>
@empty
    <section class="container px-4 mx-auto absolute w-full">
      <div class="flex items-center mt-6 text-center h-96">
        <div class="flex flex-col w-full max-w-sm px-4 mx-auto">
          <div class="p-3 mx-auto text-blue-500 bg-blue-100 rounded-full dark:bg-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
          </div>
          <h1 class="mt-3 text-lg text-gray-800 dark:text-white">No movies found</h1>
          <p class="mt-2 text-gray-500 dark:text-gray-400">We couldn't find any movies that matched your search.</p>
          <div class="flex items-center mt-4 sm:mx-auto gap-x-3">
                    <!-- Ubah tombol menjadi link -->
                    <a href="{{ route('movies.create') }}" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Add a movie</span>
                    </a>
                </div>
        </div>
      </div>
    </section>
@endforelse
</section>
@endsection

@if (session('success'))
  <div id="alert-3"
    class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 mx-20" role="alert">
    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
      viewBox="0 0 20 20">
      <path
        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
    </svg>
    <span class="sr-only">Info</span>
    <div class="ms-3 text-sm font-medium">
      {{ session('success') }}
    </div>
    <button type="button"
      class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
      data-dismiss-target="#alert-3" aria-label="Close">
      <span class="sr-only">Close</span>
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
      </svg>
    </button>
  </div>
@endif
