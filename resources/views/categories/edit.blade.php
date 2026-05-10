<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">
                    Edit Kategori
                </h1>

                <form action="{{ route('categories.update', $category->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-5">

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Kategori
                        </label>

                        <input type="text"
                               name="name"
                               value="{{ $category->name }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2
                                      focus:ring-2 focus:ring-blue-500
                                      focus:border-blue-500 outline-none">

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div class="flex justify-end gap-3">

                        <a href="{{ route('categories.index') }}"
                           class="px-4 py-2 border rounded-lg hover:bg-gray-100">
                            Batal
                        </a>

                        <button class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg">
                            Update
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>