<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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

    public function store(Request $request)
    {
        // Validasi inputan
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'year' => 'required|integer',
            'available' => 'required|boolean',
            'genre_id' => 'required|exists:genres,id',
        ]);

        // Menyimpan file poster di folder 'public/posters'
        if ($request->file('poster')) {
            // Simpan gambar ke folder 'public/posters'
            $posterPath = $request->file('poster')->store('posters', 'public');
            $validated['poster'] = basename($posterPath);  // Simpan hanya nama file
        }

        // Membuat objek Movie baru dan menyimpan data
        $movie = new Movie();
        $movie->id = Str::uuid(); // Menggunakan UUID jika diperlukan
        $movie->title = $request->input('title');
        $movie->synopsis = $request->input('synopsis');
        $movie->poster = $validated['poster']; // Menyimpan nama file gambar
        $movie->year = $request->input('year');
        $movie->available = $request->input('available');
        $movie->genre_id = $request->input('genre_id');

        // Menyimpan data movie ke database
        $movie->save();

        // Redirect ke halaman daftar movie
        return redirect()->route('movies.index')->with('success', 'Movie berhasil ditambahkan!');
    }

    // Menghapus movie berdasarkan id
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        // Menghapus file poster dari penyimpanan
        if ($movie->poster && Storage::disk('public')->exists('posters/' . $movie->poster)) {
            Storage::disk('public')->delete('posters/' . $movie->poster);
        }

        // Menghapus movie dari database
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie berhasil dihapus!');
    }

    // Menampilkan form untuk mengedit movie
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $genres = Genre::all();

        return view('movies.edit', compact('movie', 'genres'));
    }

    // Memperbarui data movie yang ada
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string',
            'synopsis' => 'required|string',
            'year' => 'required|integer',
            'available' => 'required|boolean',
            'poster' => 'nullable|image|max:2048',
            'genre_id' => 'required|exists:genres,id',
        ]);

        // Mengupdate data movie
        $movie->title = $request->title;
        $movie->synopsis = $request->synopsis;
        $movie->year = $request->year;
        $movie->available = $request->available;
        $movie->genre_id = $request->genre_id;

        // Mengupdate poster jika ada file gambar baru
        if ($request->hasFile('poster')) {
            // Hapus poster lama jika ada
            if ($movie->poster && Storage::disk('public')->exists('posters/' . $movie->poster)) {
                Storage::disk('public')->delete('posters/' . $movie->poster);
            }

            // Simpan gambar baru ke folder 'public/posters'
            $posterPath = $request->file('poster')->store('posters', 'public');
            $movie->poster = basename($posterPath);  // Simpan nama file di database
        }

        // Simpan data movie yang sudah diupdate
        $movie->save();

        return redirect()->route('movies.index')->with('success', 'Movie berhasil diperbarui!');
    }
}
