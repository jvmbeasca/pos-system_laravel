@extends('layouts.app', ['title' => 'Record Sale'])

@section('content')
<div class="card">
<h1>Record Sale</h1>
<form method="POST" action="{{ route('sales.store') }}">
    @csrf
    <label>Product</label>
    <select name="product_id" required>
        <option value="">Select a product</option>
        @foreach($products as $product)
            <option value="{{ $product->id }}" @selected(old('product_id') == $product->id)>
                {{ $product->name }} — ₱{{ number_format($product->price, 2) }} (stock: {{ $product->stock_quantity }})
            </option>
        @endforeach
    </select>

    <label>Customer (optional)</label>
    <select name="customer_id">
        <option value="">Walk-in customer</option>
        @foreach($customers as $customer)
            <option value="{{ $customer->id }}" @selected(old('customer_id') == $customer->id)>
                {{ $customer->full_name }}
            </option>
        @endforeach
    </select>

    <label>Quantity</label>
    <input type="number" min="1" name="quantity" value="{{ old('quantity', 1) }}" required>
    <button>Complete Sale</button>
</form>
</div>
@endsection