@extends('layouts.app')

@section('content')
    <div class="py-10">
        <div class="px-4 mx-auto space-y-10 max-w-7xl sm:px-6 lg:px-8">

            <!-- Greeting Box -->
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    🎉 Selamat datang di <strong>CineList</strong>! Kamu berhasil login.
                </div>
            </div>

            <!-- Statistik Ringkas -->
            @php
                $totalFilms = \App\Models\Film::count();
                $topGenre = \App\Models\Genre::withCount('films')->orderByDesc('films_count')->first();
                $avgRating = \App\Models\Film::avg('rating');
            @endphp

            <div class="grid grid-cols-1 gap-6 text-center md:grid-cols-3">
                <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-white">Total Film</h2>
                    <p class="mt-2 text-2xl font-bold text-blue-600">{{ $totalFilms }}</p>
                </div>

                <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-white">Genre Terbanyak</h2>
                    <p class="mt-2 text-gray-700 text-md dark:text-gray-300">
                        {{ $topGenre?->name ?? '-' }}
                    </p>
                </div>

                <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-white">Rata-rata Rating</h2>
                    <p class="mt-2 text-2xl font-semibold text-yellow-500">
                        {{ number_format($avgRating, 1) }}
                    </p>
                </div>
            </div>

            <!-- Tabel Film Terbaru -->
            <div>
                <h3 class="mb-4 text-lg font-bold text-gray-700 dark:text-white">5 Film Terbaru</h3>
                <div class="overflow-x-auto rounded-lg shadow">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-300">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-200">
                            <tr>
                                <th class="px-4 py-2">Judul</th>
                                <th class="px-4 py-2">Genre</th>
                                <th class="px-4 py-2">Rating</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:bg-gray-800 dark:divide-gray-700">
                            @foreach (\App\Models\Film::with('genres')->latest()->take(5)->get() as $film)
                                <tr>
                                    <td class="px-4 py-2">{{ $film->judul }}</td>
                                    <td class="px-4 py-2">
                                        {{ $film->genres->pluck('name')->implode(', ') ?: '-' }}
                                    </td>
                                    <td class="px-4 py-2">{{ $film->rating }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
