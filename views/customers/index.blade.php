@extends('layouts.app', ['title' => 'Customers'])

@section('content')
<h1>Customers</h1>
<p><a class="button" href="{{ route('customers.create') }}">Add Customer</a></p>
<table>
<tr><th>Name</th><th>Email</th><th>Phone</th><th>Actions</th></tr>
@foreach($customers as $customer)
<tr>
    <td>{{ $customer->full_name }}</td><td>{{ $customer->email }}</td><td>{{ $customer->phone }}</td>
    <td>
        <a href="{{ route('customers.edit', $customer) }}">Edit</a>
        <form class="inline" method="POST" action="{{ route('customers.destroy', $customer) }}" onsubmit="return confirm('Delete this customer?')">
            @csrf @method('DELETE') <button>Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>
@endsection