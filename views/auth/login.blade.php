@extends('layouts.app', ['title' => 'Staff Login'])

@section('content')
<div class="card">
    <h1>Staff Login</h1>
    <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        <label>Username</label>
        <input name="username" value="{{ old('username') }}" required autofocus>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Log in</button>
    </form>
</div>
@endsection