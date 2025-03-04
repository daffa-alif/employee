@extends('layouts.app')

@section('title', 'Daftar Pengguna')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Pengguna</h2>

    <button onclick="openCreateModal()" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah User</button>

    <table class="min-w-full mt-4 border bg-white shadow-md rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Role</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody id="userTable">
            @foreach ($users as $user)
            <tr id="user_{{ $user->id }}" class="border">
                <td class="px-4 py-2">{{ $user->name }}</td>
                <td class="px-4 py-2">{{ $user->email }}</td>
                <td class="px-4 py-2">{{ ucfirst($user->role) }}</td>
                <td class="px-4 py-2">
                    <button onclick="editUser({{ $user->id }})" class="text-yellow-500">Edit</button>
                    <button onclick="deleteUser({{ $user->id }})" class="text-red-500 ml-2">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="createModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-bold mb-3">Tambah User</h2>
        <form id="createUserForm">
            @csrf
            <input type="text" id="name" placeholder="Nama" class="border p-2 w-full mb-2 rounded">
            <input type="email" id="email" placeholder="Email" class="border p-2 w-full mb-2 rounded">
            <input type="password" id="password" placeholder="Password" class="border p-2 w-full mb-2 rounded">
            <select id="role" class="border p-2 w-full mb-2 rounded">
                <option value="employee">Employee</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <div class="flex gap-2">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
                <button type="button" onclick="closeCreateModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
            </div>
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

    // CREATE User
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
            let newUser = `
                <tr id="user_${data.user.id}" class="border">
                    <td class="px-4 py-2">${data.user.name}</td>
                    <td class="px-4 py-2">${data.user.email}</td>
                    <td class="px-4 py-2">${data.user.role.charAt(0).toUpperCase() + data.user.role.slice(1)}</td>
                    <td class="px-4 py-2">
                        <button onclick="editUser(${data.user.id})" class="text-yellow-500">Edit</button>
                        <button onclick="deleteUser(${data.user.id})" class="text-red-500 ml-2">Hapus</button>
                    </td>
                </tr>
            `;
            document.getElementById('userTable').innerHTML += newUser;
            closeCreateModal();
        });
    });

    // DELETE User
    function deleteUser(id) {
        fetch(`/users/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        })
        .then(response => response.json())
        .then(() => {
            document.getElementById(`user_${id}`).remove();
        });
    }
</script>
@endsection
