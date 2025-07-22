@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center mb-4">
            <img src="{{ asset('images/logo1.png') }}" alt="WashCar Logo" class="img-fluid mb-3" style="max-width: 250px;">
            <h2 class="fw-bold text-primary">Tambah Transaksi Baru</h2>
            <p class="text-muted">Isi form di bawah untuk mencatat transaksi cuci AC</p>
        </div>

        <div class="col-md-8">
            <div class="card shadow-lg border-primary">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="bi bi-plus-circle"></i> Formulir Transaksi
                </div>

                <div class="card-body">
                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Customer</label>
                            <input type="text" name="customer_name" class="form-control" required placeholder="Masukkan nama customer">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alamat Rumah</label>
                            <input type="text" name="vehicle_number" class="form-control" required placeholder="Masukkan nomor kendaraan">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tipe AC</label>
                            <select name="vehicle_category_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }} - Rp {{ number_format($c->price) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ url('/') }}" class="btn btn-outline-primary">
                                <i class="bi bi-house-door"></i> Home
                            </a>
                            <div>
                                <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary me-2">
                                    <i class="bi bi-arrow-left-circle"></i> Kembali
                                </a>
                                <button class="btn btn-success">
                                    <i class="bi bi-save"></i> Simpan Transaksi
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
