<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'POS System' }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header class="topbar">
    <a class="brand" href="{{ route('dashboard') }}">
        POS<span>System</span>
    </a>

    @auth
    <nav class="top-links">
        <a href="{{ route('products.index') }}">Products</a>
        <a href="{{ route('customers.index') }}">Customers</a>
        <a href="{{ route('sales.index') }}">Sales History</a>
    </nav>

    <div class="account-area">
        <span class="online-indicator">● Online</span>
        <span class="account-name">{{ auth()->user()->full_name }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-button" type="submit">Log out</button>
        </form>
    </div>
    @endauth
</header>

<main class="{{ request()->routeIs('dashboard') ? 'dashboard-main' : 'page-main' }}">
    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <div class="error-message">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>

</body>
</html>