@extends('layouts.app', ['title' => 'Products'])

@section('content')
<h1>Products</h1>
<p><a class="button" href="{{ route('products.create') }}">Add Product</a></p>
<table>
<tr><th>Image</th><th>Name</th><th>Price</th><th>Stock</th><th>Actions</th></tr>
@foreach($products as $product)
<tr>
    <td>@if($product->image)<img class="thumb" src="{{ asset('storage/'.$product->image) }}">@endif</td>
    <td>{{ $product->name }}</td><td>₱{{ number_format($product->price, 2) }}</td>
    <td>{{ $product->stock_quantity }}</td>
    <td>
        <a href="{{ route('products.edit', $product) }}">Edit</a>
        <form class="inline" method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Delete this product?')">
            @csrf @method('DELETE') <button>Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>
@endsection