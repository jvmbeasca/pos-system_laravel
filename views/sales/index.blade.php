@extends('layouts.app', ['title' => 'Sales History'])

@section('content')
<h1>Sales History</h1>
<p><a class="button" href="{{ route('sales.create') }}">Record Sale</a></p>
<table>
<tr><th>Date</th><th>Product</th><th>Customer</th><th>Staff</th><th>Quantity</th><th>Total</th></tr>
@foreach($sales as $sale)
<tr>
    <td>{{ $sale->created_at->format('Y-m-d H:i') }}</td>
    <td>{{ $sale->product->name }}</td>
    <td>{{ $sale->customer?->full_name ?? 'Walk-in' }}</td>
    <td>{{ $sale->staff->full_name }}</td>
    <td>{{ $sale->quantity }}</td>
    <td>₱{{ number_format($sale->total_price, 2) }}</td>
</tr>
@endforeach
</table>
@endsection