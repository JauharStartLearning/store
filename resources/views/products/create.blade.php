<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Tambah Produk</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <input type="text" name="name" placeholder="Nama Produk" class="border p-2 w-full mb-2">

            <input type="number" name="price" placeholder="Harga" class="border p-2 w-full mb-2">

            <input type="number" name="stock" placeholder="Stock" class="border p-2 w-full mb-2">

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>