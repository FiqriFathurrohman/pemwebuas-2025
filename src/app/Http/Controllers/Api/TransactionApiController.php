<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\VehicleCategory;
use Illuminate\Http\Request;

class TransactionApiController extends Controller
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

        $transactions = $query->latest()->get();

        return response()->json($transactions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'vehicle_number' => 'required|string',
            'vehicle_category_id' => 'required|exists:vehicle_categories,id',
        ]);

        $category = VehicleCategory::findOrFail($request->vehicle_category_id);

        $transaction = Transaction::create([
            'customer_name' => $request->customer_name,
            'vehicle_number' => $request->vehicle_number,
            'vehicle_category_id' => $category->id,
            'price' => $category->price,
        ]);

        return response()->json([
            'message' => 'Transaksi berhasil ditambahkan',
            'data' => $transaction,
        ], 201);
    }

    public function show($id)
    {
        $transaction = Transaction::with('category')->findOrFail($id);
        return response()->json($transaction);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'vehicle_number' => 'required|string',
            'vehicle_category_id' => 'required|exists:vehicle_categories,id',
        ]);

        $transaction = Transaction::findOrFail($id);
        $category = VehicleCategory::findOrFail($request->vehicle_category_id);

        $transaction->update([
            'customer_name' => $request->customer_name,
            'vehicle_number' => $request->vehicle_number,
            'vehicle_category_id' => $category->id,
            'price' => $category->price,
        ]);

        return response()->json([
            'message' => 'Transaksi berhasil diupdate',
            'data' => $transaction,
        ]);
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return response()->json(['message' => 'Transaksi berhasil dihapus']);
    }
}
