<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800 tracking-tight">Kasir Pintar</h2>
            <div class="text-sm font-medium text-gray-500 bg-white px-3 py-1 rounded-full shadow-sm border border-gray-100">
                {{ now()->format('d M Y • H:i') }}
            </div>
        </div>
    </x-slot>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 20px; }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb { background-color: #94a3b8; }
    </style>

    <div class="py-6 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                
                <div class="lg:col-span-2 space-y-5">
                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7L4 7M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16m6 0H8m8 0h4M4 7h16"></path></svg>
                            </div>
                            Daftar Produk
                        </h3>
                        <div class="relative w-full sm:w-96 group">
                            <input type="text" id="search" 
                                   placeholder="Cari nama produk..." 
                                   class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border-transparent rounded-xl focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all duration-300 text-sm">
                            <svg class="absolute left-4 top-3 h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>

                    <div id="product-list" class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4 max-h-[calc(100vh-220px)] overflow-y-auto custom-scrollbar pr-2 pb-4">
                        @foreach($products as $product)
                            <div class="product-card bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col cursor-pointer group"
                                 data-name="{{ strtolower($product->name) }}"
                                 data-id="{{ $product->id }}"
                                 data-price="{{ $product->price }}"
                                 onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }})">
                                
                                <div class="h-32 bg-slate-100 relative overflow-hidden flex items-center justify-center">
                                    <svg class="w-10 h-10 text-slate-300 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    @if($product->stock <= 5)
                                        <span class="absolute top-2 right-2 bg-red-100 text-red-600 text-[10px] font-bold px-2 py-1 rounded-full">Sisa {{ $product->stock }}</span>
                                    @endif
                                </div>

                                <div class="p-4 flex flex-col flex-1">
                                    <h4 class="font-bold text-gray-800 text-sm line-clamp-2 leading-tight group-hover:text-indigo-600 transition-colors">{{ $product->name }}</h4>
                                    <div class="mt-auto pt-3 flex justify-between items-end">
                                        <p class="text-indigo-700 font-extrabold tracking-tight">Rp {{ number_format($product->price,0,',','.') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                        <div id="no-results" class="hidden col-span-full flex flex-col items-center justify-center py-16 text-gray-400">
                            <div class="bg-gray-100 p-4 rounded-full mb-3">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <p class="font-medium">Produk tidak ditemukan</p>
                            <p class="text-sm mt-1">Coba kata kunci yang lain</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-100 rounded-3xl shadow-lg flex flex-col h-[calc(100vh-140px)] sticky top-6 overflow-hidden">
                    <div class="bg-white px-6 py-5 border-b border-gray-100 flex justify-between items-center z-10">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M18 13l1.5 6M9 21h6M12 18v3"></path></svg>
                            Pesanan
                        </h3>
                        <span id="cart-count" class="bg-indigo-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">0</span>
                    </div>

                    <div id="cart" class="flex-1 p-4 space-y-3 overflow-y-auto custom-scrollbar bg-slate-50/50">
                        </div>

                    <div class="border-t border-gray-100 p-6 bg-white z-10">
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-sm text-gray-500">
                                <span>Subtotal</span>
                                <span class="font-medium text-gray-700">Rp <span id="subtotal">0</span></span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-500">
                                <span>Pajak (0%)</span>
                                <span class="font-medium text-gray-700">Rp 0</span>
                            </div>
                            <div class="flex justify-between items-end pt-3 border-t border-dashed border-gray-200">
                                <span class="text-gray-500 text-sm">Total Tagihan</span>
                                <span class="text-2xl font-black text-gray-900 tracking-tight">Rp <span id="total">0</span></span>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <button id="clear-cart-btn" class="p-3 bg-red-50 hover:bg-red-100 text-red-600 rounded-xl transition-colors active:scale-95 group" title="Kosongkan Keranjang">
                                <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                            <button onclick="checkout()" class="flex-1 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-bold py-3 px-4 rounded-xl transition-all shadow-md hover:shadow-lg active:scale-[0.98] flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm0 0v4"></path></svg>
                                Proses Bayar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="payment-modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4 transition-all duration-300 opacity-0">
        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full transform transition-all duration-300 scale-95 translate-y-4" id="modal-content">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-xl font-black text-gray-800">Pembayaran</h3>
                <button onclick="closePaymentModal()" class="p-2 bg-gray-50 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <div class="p-6 space-y-5">
                <div class="bg-indigo-50 border border-indigo-100 p-4 rounded-2xl flex justify-between items-center">
                    <p class="text-sm font-medium text-indigo-600">Total Tagihan</p>
                    <p class="text-2xl font-black text-indigo-700">Rp <span id="modal-total">0</span></p>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Uang Diterima</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-gray-400 font-medium">Rp</span>
                        <input type="number" id="payment-amount" 
                               class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 text-xl font-bold text-gray-900 transition-all outline-none"
                               placeholder="0" min="0">
                    </div>
                    <div class="flex gap-2 mt-3 overflow-x-auto custom-scrollbar pb-1">
                        <button type="button" onclick="setExactAmount()" class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition-colors whitespace-nowrap">Uang Pas</button>
                    </div>
                </div>

                <div class="p-4 rounded-2xl border border-gray-100 bg-gray-50 flex justify-between items-center transition-colors duration-300" id="change-container">
                    <p class="text-sm font-medium text-gray-500" id="change-label">Kembalian</p>
                    <p class="text-2xl font-black text-gray-900" id="change-amount-display">Rp <span id="change-amount">0</span></p>
                </div>
            </div>

            <div class="p-6 border-t border-gray-100 flex gap-3 bg-gray-50 rounded-b-3xl">
                <button id="confirm-payment-btn" class="w-full bg-green-600 hover:bg-green-700 active:bg-green-800 text-white font-bold py-3.5 rounded-xl transition-all shadow-md hover:shadow-lg active:scale-[0.98] flex justify-center items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Selesaikan Transaksi (Enter)
                </button>
            </div>
        </div>
    </div>

    <div id="toast" class="fixed top-5 right-5 px-6 py-4 rounded-xl shadow-xl flex items-center gap-3 transform -translate-y-20 opacity-0 transition-all duration-400 z-50">
        <div id="toast-icon"></div>
        <span id="toast-message" class="font-semibold text-sm"></span>
    </div>

    <script>
        let cart = [];
        let currentTotal = 0;

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }

        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastMsg = document.getElementById('toast-message');
            const toastIcon = document.getElementById('toast-icon');
            
            toastMsg.innerText = message;
            toast.className = 'fixed top-5 right-5 px-6 py-4 rounded-xl shadow-xl flex items-center gap-3 transform transition-all duration-400 z-50 translate-y-0 opacity-100';
            
            if(type === 'error') {
                toast.classList.add('bg-red-600', 'text-white');
                toastIcon.innerHTML = `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`;
            } else {
                toast.classList.add('bg-gray-900', 'text-white');
                toastIcon.innerHTML = `<svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`;
            }

            setTimeout(() => {
                toast.classList.replace('translate-y-0', '-translate-y-20');
                toast.classList.replace('opacity-100', 'opacity-0');
            }, 2500);
        }

        // Logic Cart tetap dipertahankan, hanya style item cart yang diupdate
        function addToCart(id, name, price) {
            // Mencegah double event jika di klik dari button vs div
            if(event) event.stopPropagation(); 
            
            let existing = cart.find(item => item.id === id);
            if (existing) {
                existing.qty += 1;
                // Optional: matikan toast saat nambah qty agar tidak terlalu berisik
            } else {
                cart.push({ id, name, price, qty: 1 });
                showToast(`${name} ditambahkan`);
            }
            renderCart();
            
            // Efek haptic/animasi pada cart icon bisa ditambah disini
            const cartCounter = document.getElementById('cart-count');
            cartCounter.classList.add('scale-125');
            setTimeout(() => cartCounter.classList.remove('scale-125'), 200);
        }

        function increaseQty(id) {
            let item = cart.find(i => i.id === id);
            if(item) { item.qty++; renderCart(); }
        }

        function decreaseQty(id) {
            let item = cart.find(i => i.id === id);
            if(item && item.qty > 1) {
                item.qty--; renderCart();
            } else if(item && item.qty === 1) {
                removeItem(id);
            }
        }

        function removeItem(id) {
            cart = cart.filter(i => i.id !== id);
            renderCart();
        }

        function clearCart() {
            if(cart.length === 0) return;
            if(confirm("Yakin ingin mengosongkan pesanan?")) {
                cart = [];
                renderCart();
            }
        }

        function renderCart() {
            const cartDiv = document.getElementById('cart');
            const totalSpan = document.getElementById('total');
            const subtotalSpan = document.getElementById('subtotal');
            const cartCountSpan = document.getElementById('cart-count');
            
            let total = 0;
            let itemCount = 0;
            cartDiv.innerHTML = '';

            if(cart.length === 0) {
                cartDiv.innerHTML = `
                    <div class="h-full flex flex-col items-center justify-center text-gray-400 space-y-3 mt-10">
                        <div class="p-4 bg-gray-100 rounded-full">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <p class="font-medium text-sm">Belum ada pesanan</p>
                    </div>`;
                totalSpan.innerText = '0';
                subtotalSpan.innerText = '0';
                cartCountSpan.innerText = '0';
                return;
            }

            cart.forEach(item => {
                let subtotal = item.price * item.qty;
                total += subtotal;
                itemCount += item.qty;

                cartDiv.innerHTML += `
                    <div class="bg-white border border-gray-100 rounded-2xl p-3 shadow-sm flex flex-col gap-2 relative group">
                        <div class="flex justify-between items-start pr-6">
                            <h4 class="font-bold text-gray-800 text-sm leading-tight">${escapeHtml(item.name)}</h4>
                        </div>
                        <div class="flex justify-between items-end mt-1">
                            <div class="flex items-center bg-gray-50 border border-gray-200 rounded-lg p-0.5">
                                <button onclick="decreaseQty(${item.id})" class="w-8 h-8 flex items-center justify-center rounded-md bg-white text-gray-600 hover:text-indigo-600 shadow-sm transition-colors font-bold">-</button>
                                <span class="w-8 text-center font-bold text-sm text-gray-800">${item.qty}</span>
                                <button onclick="increaseQty(${item.id})" class="w-8 h-8 flex items-center justify-center rounded-md bg-white text-gray-600 hover:text-indigo-600 shadow-sm transition-colors font-bold">+</button>
                            </div>
                            <span class="font-black text-gray-900 text-sm">Rp ${formatRupiah(subtotal)}</span>
                        </div>
                        <button onclick="removeItem(${item.id})" class="absolute top-2 right-2 p-1.5 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                `;
            });

            totalSpan.innerText = formatRupiah(total);
            subtotalSpan.innerText = formatRupiah(total);
            cartCountSpan.innerText = itemCount;
        }

        function escapeHtml(str) {
            return str.replace(/[&<>]/g, function(m) {
                if(m === '&') return '&amp;'; if(m === '<') return '&lt;'; if(m === '>') return '&gt;'; return m;
            });
        }

        // --- CHECKOUT LOGIC ---
        function checkout() {
            if(cart.length === 0) {
                showToast("Pilih produk terlebih dahulu!", "error");
                return;
            }
            currentTotal = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
            
            document.getElementById('modal-total').innerText = formatRupiah(currentTotal);
            const payInput = document.getElementById('payment-amount');
            payInput.value = '';
            
            updateChangeDisplay(0, currentTotal);

            const modal = document.getElementById('payment-modal');
            const modalContent = document.getElementById('modal-content');
            
            modal.classList.remove('hidden');
            // Sedikit delay untuk memicu animasi CSS
            requestAnimationFrame(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('scale-95', 'translate-y-4');
            });
            
            setTimeout(() => payInput.focus(), 100);
        }

        function closePaymentModal() {
            const modal = document.getElementById('payment-modal');
            const modalContent = document.getElementById('modal-content');
            
            modal.classList.add('opacity-0');
            modalContent.classList.add('scale-95', 'translate-y-4');
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Shortcut Uang Pas
        function setExactAmount() {
            const input = document.getElementById('payment-amount');
            input.value = currentTotal;
            input.dispatchEvent(new Event('input'));
            input.focus();
        }

        // Hitung Kembalian & Visual Feedback
        function updateChangeDisplay(paid, total) {
            const changeContainer = document.getElementById('change-container');
            const changeAmountDisplay = document.getElementById('change-amount-display');
            const changeLabel = document.getElementById('change-label');
            const changeSpan = document.getElementById('change-amount');
            
            if (paid >= total) {
                let change = paid - total;
                changeSpan.innerText = formatRupiah(change);
                changeContainer.className = 'p-4 rounded-2xl border border-green-200 bg-green-50 flex justify-between items-center transition-colors duration-300';
                changeLabel.className = 'text-sm font-medium text-green-700';
                changeAmountDisplay.className = 'text-2xl font-black text-green-700';
            } else if (paid > 0 && paid < total) {
                let minus = total - paid;
                changeSpan.innerText = '-' + formatRupiah(minus);
                changeContainer.className = 'p-4 rounded-2xl border border-red-200 bg-red-50 flex justify-between items-center transition-colors duration-300';
                changeLabel.className = 'text-sm font-medium text-red-700';
                changeLabel.innerText = 'Kurang';
                changeAmountDisplay.className = 'text-2xl font-black text-red-700';
            } else {
                changeSpan.innerText = '0';
                changeContainer.className = 'p-4 rounded-2xl border border-gray-100 bg-gray-50 flex justify-between items-center transition-colors duration-300';
                changeLabel.className = 'text-sm font-medium text-gray-500';
                changeLabel.innerText = 'Kembalian';
                changeAmountDisplay.className = 'text-2xl font-black text-gray-900';
            }
        }

        document.getElementById('payment-amount')?.addEventListener('input', function(e) {
            let paid = parseFloat(e.target.value) || 0;
            updateChangeDisplay(paid, currentTotal);
        });

        // UX: Tekan Enter untuk bayar
        document.getElementById('payment-amount')?.addEventListener('keypress', function(e) {
            if(e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('confirm-payment-btn').click();
            }
        });

        document.getElementById('confirm-payment-btn')?.addEventListener('click', async function() {
            let paidAmount = parseFloat(document.getElementById('payment-amount').value);
            if(isNaN(paidAmount) || paidAmount < currentTotal) {
                showToast("Uang yang dimasukkan kurang!", "error");
                document.getElementById('payment-amount').focus();
                return;
            }
            
            const btn = this;
            const originalHTML = btn.innerHTML;
            btn.innerHTML = `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...`;
            btn.disabled = true;

            // Simulasi API Call
            setTimeout(() => {
                let change = paidAmount - currentTotal;
                showToast(`Transaksi Berhasil! Kembalian: Rp ${formatRupiah(change)}`);
                cart = [];
                renderCart();
                closePaymentModal();
                btn.innerHTML = originalHTML;
                btn.disabled = false;
            }, 800);
        });

        // Search dengan UX yang lebih baik
        document.getElementById('search').addEventListener('keyup', function(e) {
            let keyword = this.value.toLowerCase().trim();
            let productCards = document.querySelectorAll('.product-card');
            let hasVisible = false;
            
            productCards.forEach(card => {
                let name = card.dataset.name;
                if(name.includes(keyword)) {
                    card.style.display = 'flex';
                    hasVisible = true;
                } else {
                    card.style.display = 'none';
                }
            });
            
            document.getElementById('no-results').classList.toggle('hidden', hasVisible || keyword === '');
        });

        // Close modal when clicking outside
        document.getElementById('payment-modal').addEventListener('click', function(e) {
            if(e.target === this) closePaymentModal();
        });

        renderCart();
    </script>
</x-app-layout>