<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <h1 class="text-2xl font-bold">Daftar Produk</h1>
                    
                    <div class="flex flex-col sm:flex-row w-full md:w-auto gap-4 items-stretch">
                        <div class="relative flex-1 md:w-64">
                            <input type="text" id="search" placeholder="Cari nama produk..." 
                                   class="w-full pl-4 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                        </div>

                        <div class="relative flex-1 md:w-56">
                            <select id="categoryFilter" class="w-full py-2 pl-3 pr-8 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all bg-white">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <a href="{{ route('products.create') }}"
                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors whitespace-nowrap">
                            + Tambah Produk
                        </a>
                        <a href="{{ route('categories.index') }}"
                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors whitespace-nowrap">
                            Kelola Kategori
                        </a>
                    </div>
                </div>

                <div id="product-grid" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="product-card bg-white border rounded-lg shadow hover:shadow-lg transition-all duration-300" 
                            data-name="{{ strtolower($product->name) }}"
                            data-category="{{ $product->category_id ?? '' }}">

                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-48 object-cover rounded-t-lg">
                            @else
                                <img src="https://picsum.photos/300/200"
                                     alt="Placeholder"
                                     class="w-full h-48 object-cover rounded-t-lg grayscale">
                            @endif

                            <div class="p-4">
                                <h5 class="product-title text-lg font-semibold">
                                    {{ $product->name }}
                                </h5>

                                <p class="text-sm text-gray-500">
                                    {{ $product->category->name ?? '-' }}
                                </p>

                                <p class="text-sm mt-2 text-gray-600">
                                    {{ Str::limit($product->description, 50) }}
                                </p>

                                <h6 class="text-blue-600 font-bold mt-2">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </h6>

                                <span class="inline-block mt-2 px-2 py-1 text-xs bg-green-100 text-green-700 rounded">
                                    Stock: {{ $product->stock }}
                                </span>

                                <div class="flex gap-2 mt-4">
                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm transition-colors">
                                        Edit
                                    </a>

                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition-colors">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div id="no-results" class="hidden py-20 text-center">
                    <div class="text-gray-400 mb-2">
                        <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-lg font-medium text-gray-600">Produk tidak ditemukan</p>
                    <p class="text-gray-400">Coba kata kunci yang lain</p>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const categoryFilter = document.getElementById('categoryFilter');
            const productCards = document.querySelectorAll('.product-card');
            const noResults = document.getElementById('no-results');

            function filterProducts() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const selectedCategory = categoryFilter.value;
                let hasMatches = false;

                productCards.forEach(card => {
                    const productName = card.getAttribute('data-name');
                    const productCategory = card.getAttribute('data-category');
                    const matchesSearch = productName.includes(searchTerm);
                    const matchesCategory = selectedCategory === '' || productCategory === selectedCategory;

                    if (matchesSearch && matchesCategory) {
                        card.style.display = '';
                        hasMatches = true;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (hasMatches) {
                    noResults.classList.add('hidden');
                } else {
                    noResults.classList.remove('hidden');
                }
            }

            searchInput.addEventListener('input', filterProducts);
            categoryFilter.addEventListener('change', filterProducts);
        });
    </script>
</x-app-layout>