@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width: 1100px;">
    
    <!-- Judul Estetik -->
    <div class="row">
        <div class="col-md-12 text-center mb-4">
            <h2 class="fw-bold text-dark" style="letter-spacing: -0.5px;">Jelajahi Menu Spesial Kami</h2>
            <p class="text-muted small">Temukan hidangan favoritmu dan nikmati momen bersantap terbaik dengan mudah.</p>
        </div>
    </div>

    <!-- Section Kategori (Clean, Tanpa Emoji, Proporsional) -->
    <div class="d-flex justify-content-center gap-2 mb-4 flex-wrap">
        <a href="{{ route('customer.index', ['category' => 'Favorit']) }}" class="btn btn-sm {{ request('category') == 'Favorit' || !request('category') ? 'btn-custom-primary' : 'btn-outline-secondary text-dark border-0 bg-white shadow-sm' }} rounded-pill px-4 py-2 fw-semibold">
            semua
        </a>
        <a href="{{ route('customer.index', ['category' => 'Makanan']) }}" class="btn btn-sm {{ request('category') == 'Makanan' ? 'btn-custom-primary' : 'btn-outline-secondary text-dark border-0 bg-white shadow-sm' }} rounded-pill px-4 py-2 fw-semibold">
            Makanan
        </a>
        <a href="{{ route('customer.index', ['category' => 'Minuman']) }}" class="btn btn-sm {{ request('category') == 'Minuman' ? 'btn-custom-primary' : 'btn-outline-secondary text-dark border-0 bg-white shadow-sm' }} rounded-pill px-4 py-2 fw-semibold">
            Minuman
        </a>
        <a href="{{ route('customer.index', ['category' => 'Cemilan']) }}" class="btn btn-sm {{ request('category') == 'Cemilan' ? 'btn-custom-primary' : 'btn-outline-secondary text-dark border-0 bg-white shadow-sm' }} rounded-pill px-4 py-2 fw-semibold">
            Cemilan
        </a>
    </div>

    <form action="{{ route('customer.order') }}" method="POST">
        @csrf
        
        <!-- Card Informasi Pemesan -->
        <div class="card shadow-sm border-0 mb-4 rounded-4 bg-white" style="border: 1px solid #e2e8f0 !important;">
            <div class="card-body p-4">
                <h5 class="card-title fw-bold mb-3 text-custom-primary fs-6">Informasi Pemesan</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-secondary small fw-semibold">Nama Pelanggan</label>
                        <input type="text" name="customer_name" class="form-control rounded-3 py-2 border-slate-200 shadow-none" placeholder="Masukkan nama kamu" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-secondary small fw-semibold">Nomor Meja</label>
                        <input type="number" name="table_number" class="form-control rounded-3 py-2 border-slate-200 shadow-none" placeholder="Contoh: 05" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Menu -->
        <div class="row">
            @forelse($foods as $food)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden" style="border: 1px solid #e2e8f0 !important;">
                    @if($food->image)
                        <img src="{{ asset('storage/' . $food->image) }}" class="card-img-top" style="height: 160px; object-fit: cover;">
                    @else
                        <div class="bg-light text-muted d-flex align-items-center justify-content-center" style="height: 160px;">
                            <span class="small text-muted">Tidak ada gambar</span>
                        </div>
                    @endif
                    <div class="card-body d-flex flex-column p-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary mb-2 align-self-start px-2 py-1 rounded-pill small fw-semibold" style="font-size: 11px;">{{ $food->category }}</span>
                        
                        <h5 class="card-title fw-bold text-dark fs-6 mb-1">{{ $food->name }}</h5>
                        <p class="card-text text-muted small flex-grow-1 mb-3" style="font-size: 13px;">{{ $food->description }}</p>
                        
                        <h6 class="text-custom-primary fw-bold mb-3" style="font-size: 16px;">Rp {{ number_format($food->price, 0, ',', '.') }}</h6>
                        
                        <div class="mt-auto pt-2 border-top border-light">
                            <label class="form-label text-muted mb-1" style="font-size: 12px;">Jumlah Porsi</label>
                            <input type="number" name="foods[{{ $food->id }}]" class="form-control form-control-sm rounded-3 border-slate-200 shadow-none" value="0" min="0">
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="p-4 bg-white rounded-4 shadow-sm border border-light d-inline-block">
                    <p class="text-muted mb-1 fw-semibold">Belum ada menu untuk kategori ini.</p>
                    <p class="text-secondary small mb-0">Silakan tambahkan menu melalui panel admin terlebih dahulu.</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Tombol Kirim Pesanan -->
        <div class="text-end mt-4 mb-5">
            <button type="submit" class="btn btn-custom-primary px-5 py-2 rounded-pill shadow-sm fw-semibold">
                <i class="bi bi-cart-check me-2"></i> Kirim Pesanan Sekarang
            </button>
        </div>
    </form>
</div>
@endsection