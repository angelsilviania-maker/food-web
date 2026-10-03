@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Dashboard Admin - Rekap Pesanan</h2>
        @if(Route::has('admin.foods.index'))
            <a href="{{ route('admin.foods.index') }}" class="btn btn-primary">
                <i class="bi bi-box-seam me-1"></i> Kelola Master Makanan
            </a>
        @endif
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Pelanggan</th>
                            <th>No. Meja</th>
                            <th>Detail Pesanan</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $order->customer_name }}</td>
                            <td><span class="badge bg-secondary">Meja {{ $order->table_number }}</span></td>
                            <td>
                                <ul class="mb-0 ps-3 small">
                                    @foreach($order->details as $detail)
                                        <li>{{ $detail->food->name ?? 'Menu tidak ditemukan' }} x {{ $detail->quantity }} (Rp {{ number_format($detail->subtotal, 0, ',', '.') }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="fw-bold text-danger">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge {{ $order->status == 'Pending' ? 'bg-warning text-dark' : ($order->status == 'Diproses' ? 'bg-info' : 'bg-success') }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-flex gap-1">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Diproses" {{ $order->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada pesanan masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection