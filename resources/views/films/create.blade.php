@extends('layouts.app')

@section('content')
    <div class="max-w-3xl px-4 py-10 mx-auto">
        <h1 class="mb-6 text-2xl font-bold text-gray-800 dark:text-white">Tambah Film Baru</h1>

        <form action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Judul</label>
                <input type="text" name="judul"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring focus:ring-blue-200"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Genre</label>
                <div class="grid grid-cols-2 gap-2 mt-2">
                    @foreach ($genres as $genre)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="genres[]" value="{{ $genre->id }}"
                                class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500">
                            <span class="ml-2 text-gray-700 dark:text-gray-300">{{ $genre->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Sutradara</label>
                <input type="text" name="sutradara"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring focus:ring-blue-200"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tahun</label>
                <input type="number" name="tahun"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring focus:ring-blue-200"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Rating</label>
                <input type="number" step="0.1" name="rating"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring focus:ring-blue-200"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Sinopsis</label>
                <textarea name="sinopsis" rows="4"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring focus:ring-blue-200"
                    required></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Poster (opsional)</label>
                <input type="file" name="poster" accept="image/*"
                    class="block w-full mt-1 text-sm text-gray-500 dark:text-gray-300">
            </div>

            <div class="flex justify-end">
                <a href="{{ route('films.index') }}" class="px-4 py-2 mr-4 text-sm text-gray-600 hover:underline">Batal</a>
                <button type="submit"
                    class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
@endsection
