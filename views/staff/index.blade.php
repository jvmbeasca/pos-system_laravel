@extends('layouts.app', ['title' => 'Staff'])

@section('content')
<h1>Staff Accounts</h1>
<p><a class="button" href="{{ route('staff.create') }}">Add Staff Account</a></p>
<table>
<tr><th>Avatar</th><th>Name</th><th>Username</th><th>Email</th><th>Actions</th></tr>
@foreach($staffMembers as $staff)
<tr>
    <td>@if($staff->avatar)<img class="thumb" src="{{ asset('storage/'.$staff->avatar) }}">@endif</td>
    <td>{{ $staff->full_name }}</td><td>{{ $staff->username }}</td><td>{{ $staff->email }}</td>
    <td>
        <a href="{{ route('staff.edit', $staff) }}">Edit</a>
        @if($staff->id !== auth()->id())
        <form class="inline" method="POST" action="{{ route('staff.destroy', $staff) }}" onsubmit="return confirm('Delete this staff account?')">
            @csrf @method('DELETE') <button>Delete</button>
        </form>
        @endif
    </td>
</tr>
@endforeach
</table>
@endsection