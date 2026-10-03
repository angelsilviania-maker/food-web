<?php

namespace App\Http\Controllers;

use App\Models\Foods;
use App\Models\Orders;
use App\Models\OrdersDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    // 1. Tampilkan daftar makanan di halaman utama
    public function index()
    {
        $foods = Foods::all();
        return view('customer.index', compact('foods'));
    }

    // 2. Proses simpan transaksi pemesanan (Multi-tabel pakai DB Transaction)
    public function storeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'table_number'  => 'required',
            'items'         => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            // Hitung total harga & simpan data order utama
            $totalPrice = 0;

            $order = Orders::create([
                'customer_name' => $request->customer_name,
                'table_number'  => $request->table_number,
                'total_price'   => 0, // diupdate setelah hitung detail
                'status'        => 'Pending',
            ]);

            // Looping simpan item detail pesanan
            foreach ($request->items as $food_id => $quantity) {
                if ($quantity > 0) {
                    $food = Foods::findOrFail($food_id);
                    $subtotal = $food->price * $quantity;
                    $totalPrice += $subtotal;

                    OrdersDetail::create([
                        'order_id' => $order->id,
                        'food_id'  => $food_id,
                        'quantity' => $quantity,
                        'subtotal' => $subtotal,
                    ]);
                }
            }

            // Update total harga akhir di tabel orders
            $order->update(['total_price' => $totalPrice]);

            DB::commit();
            return redirect()->back()->with('success', 'Pesanan kamu berhasil dikirim!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }
}