<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Header --}}
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">
                        Daftar Kategori
                    </h1>

                    <a href="{{ route('categories.create') }}"
                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                        + Tambah Kategori
                    </a>
                </div>

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 rounded-lg overflow-hidden">

                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left">#</th>
                                <th class="px-4 py-3 text-left">Nama Kategori</th>
                                <th class="px-4 py-3 text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">

                            @forelse($categories as $category)
                                <tr class="hover:bg-gray-50">

                                    <td class="px-4 py-3">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-4 py-3 font-medium">
                                        {{ $category->name }}
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="flex justify-center gap-2">

                                            <a href="{{ route('categories.edit', $category->id) }}"
                                               class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                                                Edit
                                            </a>

                                            <form action="{{ route('categories.destroy', $category->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin hapus kategori ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                                    Delete
                                                </button>

                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-6 text-gray-500">
                                        Belum ada kategori.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>