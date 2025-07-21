<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\VehicleCategory;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with('category');

        if ($request->filled('customer_name')) {
            $query->where('customer_name', 'like', '%' . $request->customer_name . '%');
        }

        if ($request->filled('vehicle_number')) {
            $query->where('vehicle_number', 'like', '%' . $request->vehicle_number . '%');
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $transactions = $query->latest()->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $categories = VehicleCategory::all();
        return view('transactions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'vehicle_number' => 'required|string',
            'vehicle_category_id' => 'required|exists:vehicle_categories,id',
        ]);

        $category = VehicleCategory::find($request->vehicle_category_id);

        Transaction::create([
            'customer_name' => $request->customer_name,
            'vehicle_number' => $request->vehicle_number,
            'vehicle_category_id' => $category->id,
            'price' => $category->price,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $transaction = Transaction::with('category')->findOrFail($id);
        return view('transactions.show', compact('transaction'));
    }

    public function edit(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $categories = VehicleCategory::all();
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'vehicle_number' => 'required|string',
            'vehicle_category_id' => 'required|exists:vehicle_categories,id',
        ]);

        $transaction = Transaction::findOrFail($id);
        $category = VehicleCategory::find($request->vehicle_category_id);

        $transaction->update([
            'customer_name' => $request->customer_name,
            'vehicle_number' => $request->vehicle_number,
            'vehicle_category_id' => $category->id,
            'price' => $category->price,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
