<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show($orderId)
    {
        $order = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->findOrFail($orderId);

        return view('orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'cart' => 'required|array',
            'total_price' => 'required|numeric',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // 1. Simpan ke tabel orders
                $order = Order::create([
                    'user_id' => auth()->id(), // Pastikan user sudah login
                    'order_number' => 'INV-' . strtoupper(Str::random(10)),
                    'total_price' => $request->total_price,
                    'status' => 'paid',
                    'payment_method' => 'cash',
                ]);

                // 2. Simpan ke tabel order_items & kurangi stok produk
                foreach ($request->cart as $item) {
                    $order->items()->create([
                        'product_id' => $item['id'],
                        'quantity' => $item['qty'],
                        'price' => $item['price'],
                    ]);

                    // Update stok produk
                    Product::find($item['id'])->decrement('stock', $item['qty']);
                }
            });

            return response()->json(['message' => 'Transaksi berhasil disimpan'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}