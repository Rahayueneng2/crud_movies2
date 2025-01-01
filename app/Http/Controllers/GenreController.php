<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    // Menampilkan daftar genre
    public function index()
    {
        $genres = Genre::all();
        return view('genres.index', compact('genres'));
    }

    // Menampilkan form untuk menambah genre baru
    public function create()
    {
        return view('genres.create');
    }

    // Menyimpan genre baru ke dalam database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $validated['id'] = (string) \Illuminate\Support\Str::uuid();

        Genre::create($validated);

        return redirect()->route('genres.index')->with('success', 'Genre added successfully!');
    }
}
