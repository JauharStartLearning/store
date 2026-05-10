<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Header --}}
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">
                        Tambah Produk
                    </h1>

                    <p class="text-gray-500 mt-1">
                        Isi informasi produk baru di bawah ini.
                    </p>
                </div>

                {{-- Form --}}
                <form action="{{ route('products.store') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="space-y-5">

                    @csrf

                    {{-- Foto Produk --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Foto Produk
                        </label>

                        <input type="file"
                               name="image"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-md file:border-0
                                      file:bg-blue-50 file:text-blue-700
                                      hover:file:bg-blue-100
                                      text-sm text-gray-600">
                    </div>

                    {{-- Nama Produk --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Produk
                        </label>

                        <input type="text"
                               name="name"
                               placeholder="Masukkan nama produk"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2
                                      focus:ring-2 focus:ring-blue-500
                                      focus:border-blue-500 outline-none transition-all">
                    </div>

                    {{-- Harga --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Harga
                        </label>

                        <input type="number"
                               name="price"
                               placeholder="Masukkan harga produk"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2
                                      focus:ring-2 focus:ring-blue-500
                                      focus:border-blue-500 outline-none transition-all">
                    </div>

                    {{-- Stock --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Stock
                        </label>

                        <input type="number"
                               name="stock"
                               placeholder="Masukkan jumlah stock"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2
                                      focus:ring-2 focus:ring-blue-500
                                      focus:border-blue-500 outline-none transition-all">
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori
                        </label>

                        <select name="category_id"
                                required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2
                                       focus:ring-2 focus:ring-blue-500
                                       focus:border-blue-500 outline-none transition-all">

                            <option value="">
                                Pilih Kategori
                            </option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- Button --}}
                    <div class="flex justify-end gap-3 pt-4">

                        <a href="{{ route('products.index') }}"
                           class="px-5 py-2 rounded-lg border border-gray-300
                                  text-gray-700 hover:bg-gray-100 transition-colors">
                            Batal
                        </a>

                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600
                                       text-white px-5 py-2 rounded-lg
                                       transition-colors shadow-sm">
                            Simpan Produk
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>