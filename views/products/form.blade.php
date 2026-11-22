@extends('layouts.app', ['title' => $product->exists ? 'Edit Product' : 'Add Product'])

@section('content')
<div class="card">
<h1>{{ $product->exists ? 'Edit Product' : 'Add Product' }}</h1>
<form method="POST" enctype="multipart/form-data"
      action="{{ $product->exists ? route('products.update', $product) : route('products.store') }}">
    @csrf
    @if($product->exists) @method('PUT') @endif

    <label>Product name</label>
    <input name="name" value="{{ old('name', $product->name) }}" required>

    <label>Price</label>
    <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $product->price) }}" required>

    <label>Stock quantity</label>
    <input type="number" min="0" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}" required>

    <label>Product image</label>
    <input type="file" name="image" accept="image/*">
    @if($product->image)<p><img class="thumb" src="{{ asset('storage/'.$product->image) }}"></p>@endif

    <button>Save Product</button>
</form>
</div>
@endsection