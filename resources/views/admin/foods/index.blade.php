@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width: 1100px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark" style="letter-spacing: -0.5px;">Kelola Master Makanan</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm fw-semibold">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>

    <!-- Form Tambah Makanan -->
    <div class="card shadow-sm border-0 mb-4 rounded-4 bg-white" style="border: 1px solid #e2e8f0 !important;">
        <div class="card-body p-4">
           <h5 class="card-title fw-bold mb-3 fs-6" style="color: #1e3a8a;">Tambah Menu Baru</h5>
            <form action="{{ route('admin.foods.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label text-secondary small fw-semibold">Nama Makanan</label>
                        <input type="text" name="name" class="form-control rounded-3 py-2 border-slate-200 shadow-none" placeholder="Contoh: Paket Bundling Hemat" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-secondary small fw-semibold">Kategori</label>
                        <!-- Pilihan kategori disamakan dengan section pembeli -->
                        <select name="category" class="form-select rounded-3 py-2 border-slate-200 shadow-none" required>
                            <option value="Favorit">semua</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                            <option value="Cemilan">Cemilan</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-secondary small fw-semibold">Harga (Rp)</label>
                        <input type="number" name="price" class="form-control rounded-3 py-2 border-slate-200 shadow-none" placeholder="Contoh: 25000" required>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label text-secondary small fw-semibold">Deskripsi</label>
                        <input type="text" name="description" class="form-control rounded-3 py-2 border-slate-200 shadow-none" placeholder="Deskripsi singkat menu / promo" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-secondary small fw-semibold">Foto Menu</label>
                        <input type="file" name="image" class="form-control rounded-3 py-2 border-slate-200 shadow-none">
                    </div>
                </div>
                <button type="submit" class="btn btn-custom-primary rounded-pill px-4 py-2 mt-4 shadow-sm fw-semibold">
                    <i class="bi bi-plus-lg me-1"></i> Simpan Menu
                </button>
            </form>
        </div>
    </div>

    <!-- Tabel Daftar Makanan -->
    <div class="card shadow-sm border-0 rounded-4 bg-white" style="border: 1px solid #e2e8f0 !important;">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 text-secondary small">#</th>
                            <th class="py-3 text-secondary small">Gambar</th>
                            <th class="py-3 text-secondary small">Nama Menu</th>
                            <th class="py-3 text-secondary small">Kategori</th>
                            <th class="py-3 text-secondary small">Harga</th>
                            <th class="py-3 text-secondary small">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($foods as $food)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($food->image)
                                    <img src="{{ asset('storage/' . $food->image) }}" width="45" height="45" class="rounded-3 object-fit-cover shadow-sm">
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-1 rounded-pill">No Img</span>
                                @endif
                            </td>
                            <td class="fw-bold text-dark">{{ $food->name }}</td>
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill fw-semibold">{{ $food->category }}</span>
                            </td>
                            <td class="fw-bold text-dark">Rp {{ number_format($food->price, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('admin.foods.destroy', $food->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus menu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1">
                                        <i class="bi bi-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection