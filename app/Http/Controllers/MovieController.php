<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    // Menampilkan daftar semua movie
    public function index()
    {
        // Mendapatkan semua movie dari database
        $movies = Movie::all();

        // Menampilkan view dengan data movie
        return view('movies.index', compact('movies'));
    }

    // Menampilkan form untuk menambah movie baru
    public function create()
    {
        // Mendapatkan semua genre dari database
        $genres = Genre::all(); 

        // Mengirim data genres ke view
        return view('movies.create', compact('genres'));
    }

    // Menyimpan movie baru ke dalam database
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'poster' => 'required|url',
            'year' => 'required|integer',
            'available' => 'required|boolean',
            'genre_id' => 'required|exists:genres,id',  // Memastikan genre_id valid
        ]);

        // Membuat objek Movie baru
        $movie = new Movie();

        // Generate UUID secara otomatis untuk id
        $movie->id = Str::uuid();

        // Menyimpan data movie
        $movie->title = $request->input('title');
        $movie->synopsis = $request->input('synopsis');
        $movie->poster = $request->input('poster');
        $movie->year = $request->input('year');
        $movie->available = $request->input('available');
        $movie->genre_id = $request->input('genre_id');

        // Menyimpan movie ke database
        $movie->save();

        // Redirect ke halaman daftar movie
        return redirect()->route('movies.index')->with('success', 'Movie berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit movie
    public function edit($id)
    {
        // Mencari movie berdasarkan id
        $movie = Movie::findOrFail($id);

        // Mendapatkan semua genre dari database
        $genres = Genre::all();

        // Mengirim data movie dan genres ke view
        return view('movies.edit', compact('movie', 'genres'));
    }

    // Memperbarui data movie yang ada
    public function update(Request $request, $id)
    {
        // Validasi inputan
        $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'poster' => 'required|url',
            'year' => 'required|integer',
            'available' => 'required|boolean',
            'genre_id' => 'required|exists:genres,id', // Memastikan genre_id valid
        ]);

        // Mencari movie berdasarkan id
        $movie = Movie::findOrFail($id);

        // Memperbarui data movie
        $movie->title = $request->input('title');
        $movie->synopsis = $request->input('synopsis');
        $movie->poster = $request->input('poster');
        $movie->year = $request->input('year');
        $movie->available = $request->input('available');
        $movie->genre_id = $request->input('genre_id');

        // Menyimpan perubahan ke database
        $movie->save();

        // Redirect ke halaman daftar movie dengan pesan sukses
        return redirect()->route('movies.index')->with('success', 'Movie berhasil diperbarui!');
    }

    // Menghapus movie berdasarkan id
    public function destroy($id)
    {
        // Mencari movie berdasarkan id
        $movie = Movie::findOrFail($id);

        // Menghapus movie dari database
        $movie->delete();

        // Redirect ke halaman daftar movie dengan pesan sukses
        return redirect()->route('movies.index')->with('success', 'Movie berhasil dihapus!');
    }
}
