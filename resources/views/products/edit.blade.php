<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Produk</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $product->name }}" class="border p-2 w-full mb-2">

            <input type="number" name="price" value="{{ $product->price }}" class="border p-2 w-full mb-2">

            <input type="number" name="stock" value="{{ $product->stock }}" class="border p-2 w-full mb-2">

            <button class="bg-yellow-500 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>