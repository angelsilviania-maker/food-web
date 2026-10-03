<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\OrderDetail;
use App\Models\Foods;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    // 1. Menampilkan halaman utama untuk pembeli (daftar menu dengan filter kategori)
    public function index(Request $request)
    {
        $category = $request->get('category', 'Favorit');

        if ($category) {
            $foods = Foods::where('category', $category)->get();
            // Kalau kategori Favorit masih kosong datanya, tampilkan semua menu sebagai fallback
            if ($foods->isEmpty() && $category == 'Favorit') {
                $foods = Foods::all();
            }
        } else {
            $foods = Foods::all();
        }

        return view('customer.index', compact('foods')); 
    }

    // 2. Menyimpan Pesanan dari Pembeli
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'table_number' => 'required|string|max:50',
            'foods' => 'required|array',
        ]);

        // Hitung total harga & buat pesanan utama
        $totalPrice = 0;
        foreach ($request->foods as $foodId => $quantity) {
            if ($quantity > 0) {
                $food = Foods::find($foodId);
                if ($food) {
                    $totalPrice += $food->price * $quantity;
                }
            }
        }

        $order = Orders::create([
            'customer_name' => $request->customer_name,
            'table_number' => $request->table_number,
            'total_price' => $totalPrice,
            'status' => 'Pending',
        ]);

        // Simpan detail pesanan menggunakan OrderDetail
        foreach ($request->foods as $foodId => $quantity) {
            if ($quantity > 0) {
                $food = Foods::find($foodId);
                if ($food) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'food_id' => $foodId,
                        'quantity' => $quantity,
                        'subtotal' => $food->price * $quantity,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Pesanan berhasil dikirim!');
    }

    // 3. Menampilkan halaman Dashboard Admin Rekap Pesanan
    public function adminDashboard()
    {
        $orders = Orders::with('details.food')->latest()->get();
        return view('admin.dashboard', compact('orders'));
    }

    // 4. Update Status Pesanan (Pending -> Diproses -> Selesai)
    public function updateStatus(Request $request, $id)
    {
        $order = Orders::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}