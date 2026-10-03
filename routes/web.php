<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodsController;
use App\Http\Controllers\OrdersController;
use App\Models\Orders;
use Illuminate\Support\Facades\Route;

// Route Halaman Utama (Menu Pembeli dengan Filter Kategori)
Route::get('/', [OrdersController::class, 'index'])->name('customer.index');
Route::post('/order/store', [OrdersController::class, 'store'])->name('customer.order');

// Route Dashboard (Sudah disesuaikan agar mengirim variabel $orders)
Route::get('/dashboard', function () {
    $orders = Orders::all();
    return view('dashboard', compact('orders'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Route Khusus Admin (Kelola Makanan & Dashboard Rekap Pesanan)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/foods', [FoodsController::class, 'index'])->name('admin.foods');
    Route::post('/admin/foods', [FoodsController::class, 'store'])->name('admin.foods.store');
    Route::delete('/admin/foods/{id}', [FoodsController::class, 'destroy'])->name('admin.foods.destroy');
    
    // Dashboard Admin Rekap Pesanan
    Route::get('/admin/dashboard', [OrdersController::class, 'adminDashboard'])->name('admin.dashboard');

    // Route untuk Update Status Pesanan
    Route::put('/admin/orders/{id}/status', [OrdersController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';