@extends('layouts.app', ['title' => 'POS Dashboard'])

@section('content')
<div class="dashboard">
    <section class="welcome-panel">
        <p class="eyebrow">POINT OF SALE</p>
        <h1>Welcome, {{ auth()->user()->full_name }}</h1>
        <p class="welcome-copy">
            Manage your store and record sales from one place.
        </p>

        <div class="date-box">
            <span>{{ now()->format('l, F j, Y') }}</span>
            <strong id="clock">--:--</strong>
            <small>Your POS workspace is ready</small>
        </div>

        <div class="welcome-footer">
            <span>● System ready</span>
            <span>Signed in as {{ auth()->user()->username }}</span>
        </div>
    </section>

    <section class="menu-grid">
        <a class="menu-tile" href="{{ route('sales.create') }}">
            <span class="tile-icon">🛒</span>
            <strong>Record Sale</strong>
            <small>Start a new transaction</small>
        </a>

        <a class="menu-tile" href="{{ route('products.index') }}">
            <span class="tile-icon">📦</span>
            <strong>Products</strong>
            <small>Manage products and stock</small>
        </a>

        <a class="menu-tile" href="{{ route('customers.index') }}">
            <span class="tile-icon">👥</span>
            <strong>Customers</strong>
            <small>View customer records</small>
        </a>

        <a class="menu-tile" href="{{ route('staff.index') }}">
            <span class="tile-icon">🧑‍💼</span>
            <strong>Staff</strong>
            <small>Manage staff accounts</small>
        </a>

        <a class="menu-tile" href="{{ route('sales.index') }}">
            <span class="tile-icon">🧾</span>
            <strong>Sales History</strong>
            <small>Review transactions</small>
        </a>

        <a class="menu-tile" href="{{ route('products.index') }}">
            <span class="tile-icon">📊</span>
            <strong>Inventory</strong>
            <small>Check current stock</small>
        </a>
    </section>
</div>

<script>
    function updateClock() {
        document.getElementById('clock').textContent =
            new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }

    updateClock();
    setInterval(updateClock, 1000);
</script>
@endsection