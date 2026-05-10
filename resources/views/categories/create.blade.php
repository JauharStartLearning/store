<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">
                    Tambah Kategori
                </h1>

                <form action="{{ route('categories.store') }}" method="POST">

                    @csrf

                    {{-- Nama Kategori --}}
                    <div class="mb-5">

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Kategori
                        </label>

                        <input type="text"
                               id="name"
                               name="name"
                               placeholder="Masukkan nama kategori"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2
                                      focus:ring-2 focus:ring-blue-500
                                      focus:border-blue-500 outline-none">

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Slug --}}
                    <div class="mb-5">

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Slug
                        </label>

                        <input type="text"
                               id="slug"
                               name="slug"
                               placeholder="Slug kategori"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100
                                      focus:ring-2 focus:ring-blue-500
                                      focus:border-blue-500 outline-none">

                        @error('slug')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>
                    {{-- Description --}}
                    <div class="mb-5">

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            placeholder="Masukkan deskripsi kategori"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2
                                focus:ring-2 focus:ring-blue-500
                                focus:border-blue-500 outline-none">{{ old('description') }}</textarea>

                        @error('description')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Button --}}
                    <div class="flex justify-end gap-3">

                        <a href="{{ route('categories.index') }}"
                           class="px-4 py-2 border rounded-lg hover:bg-gray-100">
                            Batal
                        </a>

                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                            Simpan
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

    {{-- Auto Generate Slug --}}
    <script>
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        nameInput.addEventListener('keyup', function () {
            slugInput.value = nameInput.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        });
    </script>
</x-app-layout>