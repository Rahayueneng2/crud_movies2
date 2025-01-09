@extends('Layouts.index')

@section('content')
<section class="container my-24 mx-auto">
  <div class="flex justify-between px-20">
    <div class="flex items-center justify-center py-4 md:py-8 flex-wrap">
      <button type="button"
        class="text-blue-700 hover:text-white border border-blue-600 bg-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:bg-gray-900 dark:focus:ring-blue-800">
        All categories
      </button>
    </div>

    <!-- Tombol Tambah Movie -->
    <div class="flex items-center justify-center py-4 md:py-8 flex-wrap">
      <a href="{{ route('movies.create') }}"
        class="text-white hover:text-white border border-blue-600 bg-blue-700 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:bg-gray-900 dark:focus:ring-blue-800">
        Add Movie
      </a>
    </div>
  </div>

  <!-- Tabel Movie -->
  <div class="px-20">
    <table class="min-w-full border border-gray-300 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
      <thead class="bg-gray-100 dark:bg-gray-700">
        <tr>
          <th class="py-2 px-4 border-b dark:border-gray-600 text-left">#</th>
          <th class="py-2 px-4 border-b dark:border-gray-600 text-left">Title</th>
          <th class="py-2 px-4 border-b dark:border-gray-600 text-left">Synopsis</th>
          <th class="py-2 px-4 border-b dark:border-gray-600 text-left">Genre</th>
          <th class="py-2 px-4 border-b dark:border-gray-600 text-left">Year</th>
          <th class="py-2 px-4 border-b dark:border-gray-600 text-left">Available</th>
          <th class="py-2 px-4 border-b dark:border-gray-600 text-left">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($movies as $movie)
        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
          <td class="py-2 px-4 border-b dark:border-gray-600">{{ $loop->iteration }}</td>
          <td class="py-2 px-4 border-b dark:border-gray-600">{{ $movie->title }}</td>
          <td class="py-2 px-4 border-b dark:border-gray-600">{{ $movie->synopsis }}</td>
          <td class="py-2 px-4 border-b dark:border-gray-600">{{ $movie->genre->name ?? 'No Genre' }}</td>
          <td class="py-2 px-4 border-b dark:border-gray-600">{{ $movie->year }}</td>
          <td class="py-2 px-4 border-b dark:border-gray-600">{{ $movie->available ? 'Yes' : 'No' }}</td>
          <td class="py-2 px-4 border-b dark:border-gray-600">
          <div class="flex space-x-4">
          <!-- Edit Button -->
          <a href="{{ route('movies.edit', $movie->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            Edit
          </a>
          <!-- Delete Button -->
          <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400" onclick="return confirm('Are you sure?')">
              Delete
            </button>
          </form>
          </div>

          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="py-4 text-center text-gray-500 dark:text-gray-400">No movies found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>
@endsection