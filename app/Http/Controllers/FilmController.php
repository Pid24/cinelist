<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Film::with('genres');

        if ($request->filled('genre')) {
            $query->whereHas('genres', fn($q) =>
                $q->where('name', $request->genre)
            );
        }

        if ($request->filled('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $films = $query->paginate(10);
        $allGenres = \App\Models\Genre::all();

        return view('films.index', compact('films', 'allGenres'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        return view('films.create', compact('genres'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'sutradara' => 'required|string',
            'tahun' => 'required|digits:4|integer',
            'rating' => 'required|numeric|min:0|max:10',
            'sinopsis' => 'required|string',
            'poster' => 'nullable|image|max:2048',
            'genres' => 'required|array', // ← ini penting
            'genres.*' => 'exists:genres,id' // validasi isi arraynya
        ]);

        $data = $request->only(['judul', 'sutradara', 'tahun', 'rating', 'sinopsis']);

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $film = Film::create($data);

        // Tambahkan relasi genre
        $film->genres()->sync($request->genres);

        return redirect()->route('films.index')->with('success', 'Film berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Film $film)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        $genres = Genre::all();
        return view('films.edit', compact('film', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Film $film)
    {
        $request->validate([
            'judul' => 'required|string',
            'genre' => 'required|string',
            'sutradara' => 'required|string',
            'tahun' => 'required|digits:4|integer',
            'rating' => 'required|numeric|min:0|max:10',
            'sinopsis' => 'required|string',
            'poster' => 'nullable|image|max:2048'
        ]);

        $film->fill($request->except('poster'));

        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('posters', 'public');
            $film->poster = $path;
        }

        $film->save();

        return redirect()->route('films.index')->with('success', 'Film berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        $film->delete();
        return redirect()->route('films.index')->with('success', 'Film berhasil dihapus!');
    }
}
