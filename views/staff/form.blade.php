@extends('layouts.app', ['title' => $staff->exists ? 'Edit Staff' : 'Add Staff'])

@section('content')
<div class="card">
<h1>{{ $staff->exists ? 'Edit Staff Account' : 'Add Staff Account' }}</h1>
<form method="POST" enctype="multipart/form-data"
      action="{{ $staff->exists ? route('staff.update', $staff) : route('staff.store') }}">
    @csrf
    @if($staff->exists) @method('PUT') @endif
    <label>Full name</label>
    <input name="full_name" value="{{ old('full_name', $staff->full_name) }}" required>

    <label>Username</label>
    <input name="username" value="{{ old('username', $staff->username) }}" required>

    <label>Email (optional)</label>
    <input type="email" name="email" value="{{ old('email', $staff->email) }}">

    <label>Password {{ $staff->exists ? '(leave blank to keep current password)' : '' }}</label>
    <input type="password" name="password" {{ $staff->exists ? '' : 'required' }}>

    <label>Avatar (optional)</label>
    <input type="file" name="avatar" accept="image/*">
    @if($staff->avatar)<p><img class="thumb" src="{{ asset('storage/'.$staff->avatar) }}"></p>@endif

    <button>Save Staff Account</button>
</form>
</div>
@endsection