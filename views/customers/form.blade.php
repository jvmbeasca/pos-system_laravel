@extends('layouts.app', ['title' => $customer->exists ? 'Edit Customer' : 'Add Customer'])

@section('content')
<div class="card">
<h1>{{ $customer->exists ? 'Edit Customer' : 'Add Customer' }}</h1>
<form method="POST" action="{{ $customer->exists ? route('customers.update', $customer) : route('customers.store') }}">
    @csrf
    @if($customer->exists) @method('PUT') @endif
    <label>Full name</label>
    <input name="full_name" value="{{ old('full_name', $customer->full_name) }}" required>
    <label>Email (optional)</label>
    <input type="email" name="email" value="{{ old('email', $customer->email) }}">
    <label>Phone (optional)</label>
    <input name="phone" value="{{ old('phone', $customer->phone) }}">
    <button>Save Customer</button>
</form>
</div>
@endsection