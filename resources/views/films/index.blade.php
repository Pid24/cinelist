@extends('layouts.app')

@section('content')
    <div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="mb-6 text-2xl font-bold text-gray-800 dark:text-white">Daftar Film</h1>

        <!-- Filter Form -->
        <div class="mb-6">
            <form method="GET" class="flex flex-wrap items-center gap-4">
                <input type="text" name="search" placeholder="Cari Judul..." value="{{ request('search') }}"
                    class="px-3 py-2 text-sm border border-gray-300 rounded w-60" />

                <select name="genre" class="px-3 py-2 text-sm border border-gray-300 rounded">
                    <option value="">Genre</option>
                    @foreach ($allGenres as $genre)
                        <option value="{{ $genre->name }}" @selected(request('genre') === $genre->name)>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>

                <input type="number" step="0.1" name="rating" placeholder="Minimal Rating"
                    value="{{ request('rating') }}" class="w-40 px-3 py-2 text-sm border border-gray-300 rounded" />

                <button type="submit"
                    class="px-4 py-2 text-sm text-white bg-blue-600 rounded hover:bg-blue-700">Filter</button>

                <a href="{{ route('films.create') }}"
                    class="px-4 py-2 ml-auto text-sm text-white bg-green-600 rounded hover:bg-green-700">+ Tambah Film</a>
            </form>
        </div>

        <!-- Film Cards -->
        @if ($films->count())
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($films as $film)
                    <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
                        @if ($film->poster)
                            <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->judul }}"
                                class="object-cover w-full h-48 mb-4 rounded">
                        @endif

                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $film->judul }}</h3>

                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            Genre:
                            {{ $film->genres->pluck('name')->implode(', ') ?: '-' }} <br>
                            Sutradara: {{ $film->sutradara }} <br>
                            Tahun: {{ $film->tahun }} <br>
                            Rating: {{ $film->rating }}
                        </p>

                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-200">
                            {{ Str::limit($film->sinopsis, 100) }}
                        </p>

                        <div class="flex justify-between mt-4">
                            <a href="{{ route('films.edit', $film->id) }}"
                                class="text-sm text-blue-600 hover:underline">Edit</a>

                            <form action="{{ route('films.destroy', $film->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-600 hover:underline">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $films->withQueryString()->links() }}
            </div>
        @else
            <div class="mt-8 text-center text-gray-500 dark:text-gray-400">
                Belum ada film ditemukan.
            </div>
        @endif
    </div>
@endsection
