<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <!-- HEADER -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Daftar Produk</h1>

                    <a href="{{ route('products.create') }}"
                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        + Tambah Produk
                    </a>
                </div>

                <!-- GRID PRODUK -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white border rounded-lg shadow hover:shadow-lg transition">

                            <img src="https://picsum.photos/300/200"
                                 class="w-full h-48 object-cover rounded-t-lg">

                            <div class="p-4">
                                <h5 class="text-lg font-semibold">
                                    {{ $product->name }}
                                </h5>

                                <p class="text-sm text-gray-500">
                                    {{ $product->category->name ?? '-' }}
                                </p>

                                <p class="text-sm mt-2">
                                    {{ Str::limit($product->description, 50) }}
                                </p>

                                <h6 class="text-blue-600 font-bold mt-2">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </h6>

                                <span class="inline-block mt-2 px-2 py-1 text-xs bg-green-100 text-green-700 rounded">
                                    Stock: {{ $product->stock }}
                                </span>

                                <!-- ACTION BUTTON -->
                                <div class="flex gap-2 mt-4">

                                    <!-- EDIT -->
                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                                        Edit
                                    </a>

                                    <!-- DELETE -->
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>

        </div>
    </div>
</x-app-layout>