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
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }
    

    // Menampilkan form untuk menambah movie baru
    public function create()
    {
        $genres = Genre::all(); 
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
            'genre_id' => 'required|exists:genres,id',
        ]);

        // Membuat objek Movie baru
        $movie = new Movie();

        $movie->id = Str::uuid();

        // Menyimpan data movie
        $movie->title = $request->input('title');
        $movie->synopsis = $request->input('synopsis');
        $movie->poster = $request->input('poster');
        $movie->year = $request->input('year');
        $movie->available = $request->input('available');
        $movie->genre_id = $request->input('genre_id');

        $movie->save();

        // Redirect ke halaman daftar movie
        return redirect()->route('movies.index')->with('success', 'Movie berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit movie
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);

        $genres = Genre::all();

        return view('movies.edit', compact('movie', 'genres'));
    }

    // Memperbarui data movie yang ada
    public function update(Request $request, $id)
    {
        // Validasi inputan
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'poster' => 'required|url',
            'year' => 'required|integer',
            'available' => 'required|boolean',
            'genre_id' => 'required|exists:genres,id',
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

        $movie->save();

        return redirect()->route('movies.index')->with('success', 'Movie berhasil diperbarui!');
    }

    // Menghapus movie berdasarkan id
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie berhasil dihapus!');
    }
}
