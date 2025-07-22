@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center mb-4">
            <img src="{{ asset('images/logo1.png') }}" alt="WashCar Logo" class="img-fluid mb-2" style="max-width: 250px;">
            <h2 class="fw-bold text-warning">Edit Data Transaksi</h2>
            <p class="text-muted">Perbarui informasi transaksi customer Anda</p>
        </div>

        <div class="col-md-8">
            <div class="card shadow-lg border-warning">
                <div class="card-header bg-warning text-dark fw-bold">
                    <i class="bi bi-pencil-square"></i> Form Edit Transaksi
                </div>

                <div class="card-body">
                    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                        @csrf @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Customer</label>
                            <input type="text" name="customer_name" class="form-control" value="{{ $transaction->customer_name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alamat Rumah</label>
                            <input type="text" name="vehicle_number" class="form-control" value="{{ $transaction->vehicle_number }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tipe AC</label>
                            <select name="vehicle_category_id" class="form-select" required>
                                @foreach($categories as $c)
                                    <option value="{{ $c->id }}" {{ $transaction->vehicle_category_id == $c->id ? 'selected' : '' }}>
                                        {{ $c->name }} - Rp {{ number_format($c->price) }}
                                    </option>
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
                                    <i class="bi bi-save"></i> Update
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
