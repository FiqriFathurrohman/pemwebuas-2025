@extends('layouts.app')

@section('content')
<div class="container py-1">
    <div class="text-center mb-2">
        <img src="{{ asset('images/washcar.png') }}" alt="Logo" class="img-fluid mb-1" style="max-width: 250px;">
        <h2 class="fw-bold text-primary">Manajemen Transaksi WashCar</h2>
        <p class="text-muted mb-2">Kelola & pantau transaksi harian cuci mobil Anda dengan mudah</p>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-1">
        <a href="{{ url('/') }}" class="btn btn-outline-primary">
            <i class="bi bi-house-door"></i> Home
        </a>
        <a href="{{ route('transactions.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Transaksi
        </a>
    </div>

    <div class="card shadow-lg border-primary mb-2">
        <div class="card-header bg-primary text-white fw-bold">
            <i class="bi bi-search"></i> Filter Data Transaksi
        </div>
        <div class="card-body">
            <form method="GET" class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Nama Customer</label>
                    <input type="text" name="customer_name" value="{{ request('customer_name') }}" class="form-control" placeholder="Cari Nama Customer">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Nomor Kendaraan</label>
                    <input type="text" name="vehicle_number" value="{{ request('vehicle_number') }}" class="form-control" placeholder="Cari Nomor Kendaraan">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Dari Tanggal</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                </div>
                <div class="col-md-1 d-grid">
                    <button class="btn btn-primary">Filter</button>
                </div>
                <div class="col-md-1 d-grid">
                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-lg border-success mb-1">
        <div class="card-header bg-success text-white fw-bold">
            <i class="bi bi-list-ul"></i> Data Transaksi
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>No Kendaraan</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Tanggal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $i => $t)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $t->customer_name }}</td>
                        <td>{{ strtoupper($t->vehicle_number) }}</td>
                        <td><span class="badge bg-info text-dark">{{ $t->category->name }}</span></td>
                        <td><strong class="text-success">Rp {{ number_format($t->price) }}</strong></td>
                        <td>{{ $t->created_at->format('d F Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('transactions.edit', $t->id) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('transactions.destroy', $t->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Hapus data ini?')" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Data tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-end fw-bold fs-5">
        Total Pendapatan: <span class="text-success">Rp {{ number_format($transactions->sum('price')) }}</span>
    </div>
</div>
@endsection
