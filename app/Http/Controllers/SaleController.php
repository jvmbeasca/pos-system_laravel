<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['product', 'customer', 'staff'])
            ->latest()
            ->get();

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        return view('sales.create', [
            'products' => Product::orderBy('name')->get(),
            'customers' => Customer::orderBy('full_name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($data) {
            $product = Product::whereKey($data['product_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($data['quantity'] > $product->stock_quantity) {
                throw ValidationException::withMessages([
                    'quantity' => "Only {$product->stock_quantity} units are in stock.",
                ]);
            }

            $total = $product->price * $data['quantity'];

            Sale::create([
                'product_id' => $product->id,
                'customer_id' => $data['customer_id'] ?: null,
                'sold_by_user_id' => auth()->id(),
                'quantity' => $data['quantity'],
                'total_price' => $total,
            ]);

            $product->decrement('stock_quantity', $data['quantity']);
        });

        return redirect()->route('sales.index')->with('success', 'Sale recorded and stock updated.');
    }
}