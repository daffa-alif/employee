@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md w-1/2 mx-auto">
    <h2 class="text-2xl font-bold mb-4">Edit User</h2>

    <form id="editUserForm">
        @csrf
        @method('PUT')
        <input type="text" id="name" value="{{ $user->name }}" class="border p-2 w-full mb-2 rounded">
        <input type="email" id="email" value="{{ $user->email }}" class="border p-2 w-full mb-2 rounded">

        <div class="flex gap-2 mt-3">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
        </div>
    </form>
</div>

<script>
    document.getElementById('editUserForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let formData = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            role: document.getElementById('role').value,
            _token: '{{ csrf_token() }}',
            _method: 'PUT'
        };

        fetch('{{ route('users.update', $user->id) }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(() => {
            window.location.href = "{{ route('users.index') }}";
        });
    });
</script>
@endsection
