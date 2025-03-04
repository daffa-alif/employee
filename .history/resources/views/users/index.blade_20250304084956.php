@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold">Manajemen User</h2>
    <button onclick="openCreateModal()" class="bg-blue-500 text-white px-4 py-2 rounded mt-3">Tambah User</button>

    <table class="min-w-full bg-white mt-4 border">
        <thead>
            <tr class="w-full bg-gray-200">
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Role</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody id="userTable">
            @foreach ($users as $user)
            <tr class="border">
                <td class="px-4 py-2">{{ $user->name }}</td>
                <td class="px-4 py-2">{{ $user->email }}</td>
                <td class="px-4 py-2">{{ $user->role }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('users.edit', $user->id) }}" class="text-yellow-500">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="createModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold mb-3">Tambah User</h2>
        <form id="createUserForm">
            @csrf
            <input type="text" id="name" placeholder="Nama" class="border p-2 w-full mb-2">
            <input type="email" id="email" placeholder="Email" class="border p-2 w-full mb-2">
            <input type="password" id="password" placeholder="Password" class="border p-2 w-full mb-2">
            <select id="role" class="border p-2 w-full mb-2">
                <option value="employee">Employee</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
            <button type="button" onclick="closeCreateModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
        </form>
    </div>
</div>

<script>
    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
    }

    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
    }

    document.getElementById('createUserForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        let formData = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            password: document.getElementById('password').value,
            role: document.getElementById('role').value,
            _token: '{{ csrf_token() }}'
        };

        fetch('{{ route('users.store') }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            location.reload();
        })
        .catch(error => console.log(error));
    });
</script>
@endsection
