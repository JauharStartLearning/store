<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">Detail Pesanan</h2>
                <p class="mt-1 text-sm text-gray-500">Lihat detail barang dan harga untuk pesanan ini.</p>
            </div>
            <a href="{{ route('orders.index') }}" class="inline-flex items-center rounded-full bg-indigo-50 px-4 py-2 text-sm font-semibold text-indigo-700 hover:bg-indigo-100 transition">
                Kembali ke Daftar Pesanan
            </a>
        </div>
    </x-slot>

    <div class="py-6 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-[1.5fr_1fr] mb-6">
                <div class="bg-white border border-gray-100 shadow-sm rounded-3xl p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Informasi Pesanan</h3>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="space-y-1">
                            <p class="text-sm text-gray-500">Nomor Pesanan</p>
                            <p class="font-semibold text-gray-900">{{ $order->order_number }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm text-gray-500">Tanggal</p>
                            <p class="font-semibold text-gray-900">{{ $order->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm text-gray-500">Metode Pembayaran</p>
                            <p class="font-semibold text-gray-900">{{ ucfirst($order->payment_method) }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm text-gray-500">Status</p>
                            <p class="inline-flex items-center rounded-full px-3 py-1 text-sm font-semibold uppercase tracking-wide {{ $order->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700' }}">{{ ucfirst($order->status) }}</p>
                        </div>
                        <div class="sm:col-span-2 space-y-1">
                            <p class="text-sm text-gray-500">Jumlah Item</p>
                            <p class="font-semibold text-gray-900">{{ $order->items->sum('quantity') }} item</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-100 shadow-sm rounded-3xl p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Ringkasan Biaya</h3>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span class="font-semibold text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Pajak</span>
                            <span class="font-semibold text-gray-900">Rp 0</span>
                        </div>
                        <div class="flex justify-between pt-3 border-t border-dashed border-gray-200">
                            <span class="font-semibold">Total</span>
                            <span class="font-bold text-gray-900 text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-100 shadow-sm rounded-3xl overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Detail Produk</h3>
                </div>
                <div class="p-6 overflow-x-auto">
                    @if($order->items->isEmpty())
                        <div class="rounded-3xl border border-dashed border-gray-200 bg-gray-50 p-10 text-center">
                            <p class="text-gray-500 text-sm">Tidak ada item untuk pesanan ini.</p>
                        </div>
                    @else
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Kuantitas</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($order->items as $item)
                                    <tr>
                                        <td class="px-4 py-4 text-gray-900">
                                            {{ optional($item->product)->name ?? 'Produk tidak tersedia' }}
                                        </td>
                                        <td class="px-4 py-4 text-gray-600">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-4 text-gray-600">{{ $item->quantity }}</td>
                                        <td class="px-4 py-4 text-gray-900">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
