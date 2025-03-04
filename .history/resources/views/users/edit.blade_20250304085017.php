@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold">Edit User</h2>

    <form id="editUserForm">
        @csrf
        @method('PUT')
        <input type="text" id="name" value="{{ $user->name }}" class="border p-2 w-full mb-2">
        <input type="email" id="email" value="{{ $user->email }}" class="border p-2 w-full mb-2">
        <select id="role" class="border p-2 w-full mb-2">
            <option value="employee" {{ $user->role == 'employee' ? 'selected' : '' }}>Employee</option>
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>

<script>
    document.getElementById('editUserForm').addEventListener('submit', function(e) {
        e.preventDefault();

        fetch('{{ route('users.update', $user->id) }}', {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                role: document.getElementById('role').value,
                _token: '{{ csrf_token() }}'
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            window.location.href = "{{ route('users.index') }}";
        });
    });
</script>
@endsection
