<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">Riwayat Pesanan</h2>
                <p class="mt-1 text-sm text-gray-500">Lihat semua pesanan yang telah diproses oleh kasir Anda.</p>
            </div>
            <span class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 text-sm font-semibold text-indigo-700">
                {{ $orders->count() }} Pesanan
            </span>
        </div>
    </x-slot>

    <div class="py-6 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-3xl border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Daftar Pesanan</h3>
                </div>

                <div class="p-6 overflow-x-auto">
                    @if($orders->isEmpty())
                        <div class="rounded-3xl border border-dashed border-gray-200 bg-gray-50 p-10 text-center">
                            <p class="text-gray-500 text-sm">Belum ada pesanan yang tercatat.</p>
                        </div>
                    @else
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Nomor Pesanan</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Item</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider"></th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="px-4 py-4 font-medium text-gray-900">{{ $order->order_number }}</td>
                                        <td class="px-4 py-4 text-gray-600">{{ $order->created_at->format('d M Y H:i') }}</td>
                                        <td class="px-4 py-4 text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-4 text-gray-600">{{ $order->items->sum('quantity') }} item</td>
                                        <td class="px-4 py-4">
                                            <a href="{{ route('orders.show', $order) }}" class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 text-indigo-700 text-sm font-semibold hover:bg-indigo-100 transition">
                                                Detail
                                            </a>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wide {{ $order->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700' }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
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
