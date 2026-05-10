<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-4">
                    {{ $category->name }}
                </h1>

                <a href="{{ route('categories.index') }}"
                   class="inline-block mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Kembali
                </a>

            </div>

        </div>
    </div>
</x-app-layout>